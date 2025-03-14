document.addEventListener("DOMContentLoaded", () => {
    const form = document.querySelector("#contactForm");
    if (!form) {
        console.error("Error: contactForm not found!");
        return;
    }

    const feedback = document.querySelector("#feedback");

    async function regForm(event) {
        event.preventDefault();

        const url = "admin/send_mail.php"; 
        const formData = new FormData(form); 

        console.log("Submitting form data...");

        try {
            const response = await fetch(url, {
                method: "POST",
                body: formData 
            });

            if (!response.ok) {
                throw new Error(`HTTP error! Status: ${response.status}`);
            }

            const data = await response.json();
            console.log("Response received:", data);

            feedback.innerHTML = "";

            if (data.errors) {
                data.errors.forEach(error => {
                    const errorElement = document.createElement("p");
                    errorElement.textContent = error;
                    errorElement.style.color = "red";
                    feedback.appendChild(errorElement);
                });
            } else {
                form.reset();
                const successMessage = document.createElement("p");
                successMessage.textContent = data.message;
                successMessage.style.color = "green";
                feedback.appendChild(successMessage);
            }

            feedback.scrollIntoView({ behavior: 'smooth', block: 'end' });

        } catch (error) {
            console.error("Fetch error:", error);
            feedback.innerHTML = "<p style='color: red;'>Error submitting the form. Please try again.</p>";
        }
    }

    form.addEventListener("submit", regForm);
});
