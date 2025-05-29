document.addEventListener("DOMContentLoaded", function () {
    const chatbotToggle = document.getElementById("chatbot-toggle");
    const chatbotContainer = document.getElementById("chatbot-container");
    const chatbotClose = document.getElementById("chatbot-close");

    if (chatbotToggle && chatbotContainer) {
        chatbotToggle.addEventListener("click", function () {
            chatbotContainer.style.display = "block";
            chatbotToggle.style.display = "none";
        });
    }
    if (chatbotClose && chatbotContainer && chatbotToggle) {
        chatbotClose.addEventListener("click", function () {
            chatbotContainer.style.display = "none";
            chatbotToggle.style.display = "block";
        });
    }
});
