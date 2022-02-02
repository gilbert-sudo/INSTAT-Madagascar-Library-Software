
async function getUpdatedatabase() {
    return (await fetch("../check_internet.php")).json();
}

setInterval(async () => {
    let response = [];
    try {
        response = await getUpdatedatabase();
    } catch (e) {
        response = "failed";
    }
    if (response != "failed") {
        _id("downloadLink").setAttribute("href", download);
        _id("downloadLink").removeAttribute("disabled");
    } else {
        _id("download").setAttribute("href", "#");
        _id("downloadLink").setAttribute("disabled","true");
    }
}, 1000);

