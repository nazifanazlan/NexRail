//Function for all pages to toggle the dropdown menu
function toggleDropdown() {
    var dropdown = document.getElementById("dropdown");
    if (dropdown.style.display === "flex") {
        dropdown.style.display = "none";
    } else {
        dropdown.style.display = "flex";
    }
}

//Function for xxx_schedule.php to expand the table
function showMore() {
    var rows = document.querySelectorAll('.hidden-row');
    rows.forEach(function(row) {
        row.style.display = 'table-row';
    });
    document.querySelector('.show-more').style.display = 'none';
    document.querySelector('.show-less').style.display = 'block';
}

function showLess() {
    var rows = document.querySelectorAll('.hidden-row');
    rows.forEach(function(row) {
        row.style.display = 'none';
    });
    document.querySelector('.show-more').style.display = 'block';
    document.querySelector('.show-less').style.display = 'none';
}