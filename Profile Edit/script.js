document.addEventListener("DOMContentLoaded", function () {

    const tagInput = document.getElementById("tagInput");
    const tagContainer = document.getElementById("tagContainer");
    const hiddenInput = document.getElementById("expertiseList");

    let tags = [];

    // Load existing DB tags into memory (optional but recommended)
    document.querySelectorAll(".existing-tag").forEach(tag => {
        tags.push(tag.textContent.trim());
    });

    // Update hidden input
    function updateHiddenInput() {
        hiddenInput.value = JSON.stringify(tags);
    }

    // Create tag element
    function createTag(label) {
        const span = document.createElement("span");
        span.classList.add("tag-chip");

        span.innerHTML = `
            ${label}
            <i class="ti ti-x"></i>
        `;

        // remove handler
        span.querySelector("i").addEventListener("click", function () {
            tags = tags.filter(t => t !== label);
            span.remove();
            updateHiddenInput();
        });

        return span;
    }

    // Enter key handler
    tagInput.addEventListener("keydown", function (e) {
        if (e.key === "Enter") {
            e.preventDefault();

            const value = tagInput.value.trim();

            if (value === "") return;
            if (tags.includes(value)) {
                tagInput.value = "";
                return;
            }

            tags.push(value);

            const tagElement = createTag(value);

            // insert before input
            tagContainer.insertBefore(tagElement, tagInput);

            tagInput.value = "";

            updateHiddenInput();
        }
    });

    // Optional: remove DB tags visually (frontend only)
    document.querySelectorAll(".remove-db-tag").forEach(btn => {
        btn.addEventListener("click", function () {
            const label = this.parentElement.textContent.trim();
            this.parentElement.remove();

            tags = tags.filter(t => t !== label);
            updateHiddenInput();
        });
    });

    // Ensure data is ready on submit
    document.querySelector("form").addEventListener("submit", function () {
        updateHiddenInput();
    });

});