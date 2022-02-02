
async function getPdf() {
    return (await fetch(downloadUrl)).json();
}

document.addEventListener("DOMContentLoaded", async () => {
    let response = [];
    try {
        response = await getPdf();
    } catch (e) {
        console.log("Error!");
        document.getElementById("error").innerHTML = "Error!...";
        window.location.href = "../description.php?ID=" + id;
    }
    if (response.state == "finished" && response.response == "success") {
        // document.getElementById("count").innerHTML = "100";
        console.log(response);
        document.getElementById("count").innerHTML = "100";
        window.location.href = "../description.php?success=2&ID=" + response.id;
    }
});
