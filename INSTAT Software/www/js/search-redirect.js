_id("searchInput").addEventListener("focus", function(e) {
   window.location.href = `Result.php?keyword=${e.target.value}`;
});