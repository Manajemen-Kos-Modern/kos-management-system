document.addEventListener("DOMContentLoaded", function () {
    const chatbotToggle = document.getElementById("chatbot-toggle");
    const chatbotContainer = document.getElementById("chatbot-container");
    const chatbotClose = document.getElementById("chatbot-close");

    // Pastikan posisi awal: chatbot tertutup, toggle terlihat
    if (chatbotContainer) chatbotContainer.style.display = "none";
    if (chatbotToggle) chatbotToggle.style.display = "block";

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

    let faqData = [];

    // Load FAQ data
    fetch("/faq.json")
        .then((res) => res.json())
        .then((data) => {
            faqData = data;
        });

    // Fungsi cari jawaban
    function findAnswer(question) {
        question = question.toLowerCase();
        for (const item of faqData) {
            if (item.keywords.some((keyword) => question.includes(keyword))) {
                return item.answer;
            }
        }
        return "Maaf, saya belum mengerti pertanyaan Anda.";
    }

    // Event handler kirim chat
    const chatForm = document.getElementById("chatbot-form");
    const chatInput = document.getElementById("chatbot-input");
    if (chatForm && chatInput) {
        chatForm.addEventListener("submit", function (e) {
            e.preventDefault();
            const userMsg = chatInput.value.trim();
            if (!userMsg) return;
            const firstBotMsg = document.querySelector(".bot-message");
            if (
                firstBotMsg &&
                firstBotMsg.textContent.includes(
                    "Halo! Ada yang bisa saya bantu?"
                )
            ) {
                firstBotMsg.style.display = "none";
            }
            addMessage("user", userMsg);
            const botMsg = findAnswer(userMsg);
            setTimeout(() => addMessage("bot", botMsg), 400); // efek typing
            chatInput.value = "";
        });
    }

    // Fungsi menambah pesan ke chat
    function addMessage(sender, text) {
        const chatBox = document.getElementById("chatbot-messages");
        const msgDiv = document.createElement("div");
        if (sender === "user") {
            msgDiv.className = "user-message";
            msgDiv.textContent = text;
        } else {
            msgDiv.className = "bot-message";
            msgDiv.innerHTML = text; // <-- gunakan innerHTML untuk bot
        }
        chatBox.appendChild(msgDiv);
        chatBox.scrollTop = chatBox.scrollHeight;
    }
});