//search suggestions
const search = document.getElementById('searchInput');
const matchList = document.getElementById('matchList');


//search states.json and filter it
const searchStates = async searchText => {
    const res = await fetch('../products.php');
    const states = await res.json();

    //get matches to current text input
    let matches = states.filter(state => {
        const regex = new RegExp(`^${searchText}`, 'gi');
        return state.Title.match(regex) || state.Category.match(regex) || state.Description.match(regex);
    });

    if (searchText.length === 0) {
        matches = [];
        matchList.innerHTML = '';
    }
    if (searchText.length != 0) {
        outputHTML(matches);
    }

};

//show results in HTML 
const outputHTML = matches => {

    if (matches.length > 0) {
            const html = matches.map(match => `
            <div class="col-md-3 col-sm-6" style="margin-top: 10px;">
                <div class="product-grid">
                    <div class="product-image">
                        <a href="description.php?ID=${match.PID}" class="image">
                            <img src="img/books/${match.img}">
                        </a>
                        <a href="description.php?ID=${match.PID}" class="add-to-cart">LIRE</a>
                    </div>
                    <div class="product-content">
                        <h3 class="title"><a href="description.php?ID=${match.PID}">${match.Title}</a></h3>
                    </div>
                </div>
            </div>
        </div>
        `).join('');
       

        matchList.innerHTML = html;

    }
}




search.addEventListener('input', () => searchStates(search.value));