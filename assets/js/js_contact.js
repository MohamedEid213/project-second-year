function sendMessage() {
    let name = document.getElementById("name").value;
    let email = document.getElementById("email").value;
    let message = document.getElementById("message").value;

    if (name == "" || email == "" || message == "") {
        alert("Please fill all fields");
    } else {
        alert("Message Sent Successfully!");
        document.querySelector("form").reset();
    }
}