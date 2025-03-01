// Dynamic Navigation Highlight
document.addEventListener("DOMContentLoaded", () => {
    const navLinks = document.querySelectorAll("nav ul li a");
    navLinks.forEach(link => {
        if (link.href === window.location.href) {
            link.style.color = "#f39c12"; // Highlight the current page
            link.style.fontWeight = "bold";
        }
    });
});

// Form Validation (Report Item)
const reportForm = document.querySelector("form");
if (reportForm) {
    reportForm.addEventListener("submit", event => {
        const itemName = document.getElementById("item-name").value.trim();
        const category = document.getElementById("category").value;
        const location = document.getElementById("location").value.trim();
        const description = document.getElementById("description").value.trim();
        const contactInfo = document.getElementById("contact-info").value.trim();

        if (!itemName || !category || !location || !description || !contactInfo) {
            event.preventDefault();
            alert("All fields are required! Please fill out the form completely.");
        }
    });
}

// Dynamic Item Addition (Lost and Found Items)
const itemList = document.querySelector(".item-list");
if (itemList) {
    // Example of dynamic item addition
    const newItem = {
        imgSrc: "item.jpg",
        name: "Umbrella",
        location: "Library",
        contact: "987-654-3210",
        status: "Found"
    };

    const addItem = (item) => {
        const itemDiv = document.createElement("div");
        itemDiv.classList.add("item");

        itemDiv.innerHTML = `
            <img src="${item.imgSrc}" alt="Item Image">
            <p><strong>Item:</strong> ${item.name}</p>
            <p><strong>Location:</strong> ${item.location}</p>
            <p><strong>Contact:</strong> ${item.contact}</p>
            <p><strong>Status:</strong> ${item.status}</p>
        `;
        itemList.appendChild(itemDiv);
    };

    // Example call to add an item
    addItem(newItem);
}

// Search Functionality (Lost and Found Items)
const searchBar = document.createElement("input");
if (itemList) {
    searchBar.type = "text";
    searchBar.placeholder = "Search items...";
    searchBar.style.margin = "20px auto";
    searchBar.style.display = "block";
    searchBar.style.padding = "10px";
    searchBar.style.width = "90%";
    searchBar.style.maxWidth = "600px";
    document.querySelector("main").insertBefore(searchBar, itemList);

    searchBar.addEventListener("input", event => {
        const searchValue = event.target.value.toLowerCase();
        const items = itemList.querySelectorAll(".item");
        items.forEach(item => {
            const itemName = item.querySelector("p:nth-of-type(1)").textContent.toLowerCase();
            const itemLocation = item.querySelector("p:nth-of-type(2)").textContent.toLowerCase();
            if (itemName.includes(searchValue) || itemLocation.includes(searchValue)) {
                item.style.display = "flex";
            } else {
                item.style.display = "none";
            }
        });
    });
}
