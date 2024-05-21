document.addEventListener("DOMContentLoaded", function() {
    const tabs = document.querySelectorAll("li[id^='tab-']");
    const contents = document.querySelectorAll("section[id^='content-']");

    tabs.forEach(tab => {
        tab.addEventListener("click", () => {
            const tabId = tab.id.replace('tab-', 'content-');

            contents.forEach(content => {
                if (content.id === tabId) {
                    content.classList.remove("hidden");
                } else {
                    content.classList.add("hidden");
                }
            });

            tabs.forEach(t => {
                if (t === tab) {
                    t.classList.add("bg-gray-200");
                    t.classList.remove("hover:bg-gray-300");
                } else {
                    t.classList.remove("bg-gray-200");
                    t.classList.add("hover:bg-gray-300");
                }
            });
        });
    });
});