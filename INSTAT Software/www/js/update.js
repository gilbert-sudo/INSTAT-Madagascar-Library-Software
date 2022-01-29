async function getUpdate() {
  return (await fetch("../get_update.php")).json();
}
async function getUpdatestate() {
  return (await fetch("../update_state.php")).json();
}

if (isOnline() == "online") {
  document.addEventListener("DOMContentLoaded", async () => {
    let response = [];
    let updatestate = [];
    try {
      response = await getUpdate();
    } catch (e) {   
      console.group("Error!");
      console.log(e);
    }
    try {
      updatestate = await getUpdatestate();
    } catch (e) {
      console.group("Error!");
      console.log(e);
    }

    console.log(response);
    console.log(updatestate);

    if (updatestate.need_update == 1) {
      swal({
        title: "Des nouveaux livres sont arrivés !",
        text: "Pas besoin d'internet, ça ne prendra que quelques secondes!",
        icon: "info",
        button: {
          text: "Les ajouter",
        },
        closeOnClickOutside: false,
      })
      .then((willDelete) => {
        if (willDelete) {
         window.location.href = "loading.html";
        } 
      });
    }
  });
} else {
  console.log("You are offline!");
}
