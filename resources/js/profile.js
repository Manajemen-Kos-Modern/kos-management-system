document.addEventListener("DOMContentLoaded", () => {
    const sidebar = document.querySelector(".sidebar");
    const mainContent = document.querySelector(".main-content");
    const menuItems = document.querySelectorAll(".menu-list li a");
    const menuIcons = document.querySelectorAll(".menu-list li span");

    // Sidebar toggle functionality
    let isCollapsed = false;
    sidebar.addEventListener("click", () => {
        isCollapsed = !isCollapsed;

        if (isCollapsed) {
            sidebar.classList.add("collapsed");
            mainContent.style.marginLeft = "5%";
            menuItems.forEach((item) => {
                item.style.display = "none";
            });
            menuIcons.forEach((icon) => {
                icon.style.textAlign = "center";
                icon.style.width = "100%";
            });
        } else {
            sidebar.classList.remove("collapsed");
            mainContent.style.marginLeft = "20%";
            menuItems.forEach((item) => {
                item.style.display = "inline";
            });
            menuIcons.forEach((icon) => {
                icon.style.textAlign = "left";
                icon.style.width = "auto";
            });
        }
    });
});

document.addEventListener("DOMContentLoaded", () => {
    const chatbotToggle = document.getElementById("chatbot-toggle");
    const chatbotContainer = document.getElementById("chatbot-container");
    const chatbotClose = document.getElementById("chatbot-close");

    // Toggle chatbot visibility when the toggle button is clicked
    chatbotToggle.addEventListener("click", () => {
        if (
            chatbotContainer.style.display === "none" ||
            chatbotContainer.style.display === ""
        ) {
            chatbotContainer.style.display = "block";
        } else {
            chatbotContainer.style.display = "none";
        }
    });

    // Close chatbot when the close button is clicked
    chatbotClose.addEventListener("click", () => {
        chatbotContainer.style.display = "none";
    });

    // document.addEventListener('DOMContentLoaded', () => {
    //     const logoutButton = document.querySelector('.logout-button');
    //     if (logoutButton) {
    //         logoutButton.addEventListener('click', (e) => {
    //             if (!confirm('Apakah Anda yakin ingin logout?')) {
    //                 e.preventDefault();
    //             }
    //         });
    //     }
    // });
});