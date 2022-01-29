
async function getPdf() {
    return (await fetch(downloadUrl)).json();
}

document.addEventListener("DOMContentLoaded", async () => {
    let response = [];
    try {
        response = await getPdf();
    } catch (e) {
        console.group("Error!");
        console.log(e);
    }
    if (response.state == "finished" && response.response == "success") {
        // document.getElementById("count").innerHTML = "100";
        console.log(response);
        document.getElementById("count").innerHTML = "100";
        window.location.href = "../description.php?ID=" + response.id;
    }
});
