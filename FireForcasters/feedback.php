<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Feedback Form</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap');

        * {
            box-sizing: border-box;
        }

        html, body {
            height: 100%;
            margin: 0;
            font-family: 'Poppins', sans-serif;
        }

        body {
            display: flex;
            justify-content: center;
            align-items: center;
            background: url(https://performancemanagement.io/_next/image/?url=https%3A%2F%2Fcdn.sanity.io%2Fimages%2Fqa6lj5pi%2Fproduction%2F111ee33efe561629f9131634a0d2539fec930e77-1792x1024.webp%3Fw%3D1792%26q%3D100%26auto%3Dformat&w=3840&q=100) no-repeat center center;
            background-size: cover;
        }

        .container {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(20px);
            border: 3px solid rgba(77, 72, 72, 0.7);
            border-radius: 15px;
            padding: 30px;
            width: 90%;
            max-width: 600px;
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.5);
        }

        .container form {
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .container form h2 {
            color: #045a80;
            margin-bottom: 20px;
            font-weight: 600;
        }

        .container form input,
        .container form textarea {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: none;
            border-bottom: 2px solid #fff;
            background: transparent;
            color: #111;
            font-size: 15px;
        }

        .container form input::placeholder,
        .container form textarea::placeholder {
            color: #111;
        }

        .container form textarea {
            resize: none;
            min-height: 80px;
        }

        textarea::-webkit-scrollbar {
            width: 8px;
        }

        textarea::-webkit-scrollbar-thumb {
            background-color: rgba(194, 194, 194, 0.7);
        }

        #button {
            border: none;
            background: #fff;
            border-radius: 5px;
            font-weight: 600;
            font-size: 16px;
            color: #171818;
            padding: 10px 20px;
            cursor: pointer;
            transition: 0.3s;
        }

        #button:hover {
            opacity: 0.6;
        }
    </style>
</head>
<body>
    <div class="container">
        <form id="feedbackForm">
            <h2>Feedback Form</h2>
            <input type="text" name="name" id="name" placeholder="Your Name" required>
            <input type="email" name="email" id="email" placeholder="Your Email" required>
            <textarea name="feedback" id="feedback" placeholder="Your Feedback" required></textarea>
            <input type="number" name="rating" id="rating" placeholder="Rating (1-5)" min="1" max="5" required>
            <button type="submit" id="button">Submit Feedback</button>
        </form>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Load feedback on page load
            loadFeedback();

            // Handle form submission
            document.getElementById("feedbackForm").addEventListener("submit", function(event) {
                event.preventDefault();

                var formData = new FormData(this);

                fetch("submit_feedback.php", {
                    method: "POST",
                    body: formData
                })
                .then(response => response.text())
                .then(data => {
                    alert(data);
                    loadFeedback();
                    this.reset();
                })
                .catch(error => console.error('Error:', error));
            });
        });

        function loadFeedback() {
            fetch("fetch_feedback.php")
            .then(response => response.json())
            .then(data => {
                var feedbackTableBody = document.querySelector("#feedbackTable tbody");
                if (!feedbackTableBody) return; // Avoid error if feedbackTable doesn't exist

                feedbackTableBody.innerHTML = "";

                data.forEach(feedback => {
                    var row = document.createElement("tr");
                    row.innerHTML = `
                        <td>${feedback.id}</td>
                        <td>${feedback.name}</td>
                        <td>${feedback.email}</td>
                        <td>${feedback.feedback}</td>
                        <td>${feedback.rating}</td>
                        <td>${feedback.submission_date}</td>
                    `;
                    feedbackTableBody.appendChild(row);
                });
            })
            .catch(error => console.error('Error:', error));
        }
    </script>
</body>
</html>
