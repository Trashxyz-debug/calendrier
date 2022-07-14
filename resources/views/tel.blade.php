<!DOCTYPE html>
<html lang="en">
  <head>
    <title>International telephone input</title>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/css/intlTelInput.css"
    />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/intlTelInput.min.js"></script>
    <style>
    body {
      font-family: Helvetica, sans-serif;
    }

    .container {
      max-width: 800px;
      margin-left: auto;
      margin-right: auto;
      padding: 10px;
    }

    #phone, .btn {
      padding-top: 6px;
      padding-bottom: 6px;
      border: 1px solid #ccc;
      border-radius: 4px;
    }

    .btn {
      color: #ffffff;
      background-color: #428BCA;
      border-color: #357EBD;
      font-size: 14px;
      outline: none;
      cursor: pointer;
      padding-left: 12px;
      padding-right: 12px;
    }

    .btn:focus, .btn:hover {
      background-color: #3276B1;
      border-color: #285E8E;
    }

    .btn:active {
      box-shadow: inset 0 3px 5px rgba(0,0,0,.125);
    }

    .alert {
      padding: 15px;
      margin-top: 10px;
      border: 1px solid transparent;
      border-radius: 4px;
    }

    .alert-info {
      border-color: #bce8f1;
      color: #31708f;
      background-color: #d9edf7;
    }

    .alert-error {
      color: #a94442;
      background-color: #f2dede;
      border-color: #ebccd1;
    }    
    </style>

  </head>
  <body>
    <div class="container">
      <form id="login" onsubmit="process(event)">
        <p>Enter your phone number:</p>
        <input id="phone" type="tel" name="phone" />
        <input type="submit" class="btn" value="Verify" />
      </form>
      <div class="alert alert-info" style="display: none"></div>
      <div class="alert alert-error" style="display: none"></div>
    </div>
  </body>
  <script>
    const phoneInputField = document.querySelector("#phone");
    const phoneInput = window.intlTelInput(phoneInputField, {
      utilsScript:
        "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/utils.js",
    });

    const info = document.querySelector(".alert-info");
    const error = document.querySelector(".alert-error");

    function process(event) {
      event.preventDefault();

      const phoneNumber = phoneInput.getNumber();

      info.style.display = "none";
      error.style.display = "none";

      const data = new URLSearchParams();
      data.append("phone", phoneNumber);

      fetch("http://<your-url-here>.twil.io/lookup", {
        method: "POST",
        body: data,
      })
        .then((response) => response.json())
        .then((json) => {
          if (json.success) {
            info.style.display = "";
            info.innerHTML = `Phone number in E.164 format: <strong>${phoneNumber}</strong>`;
          } else {
            console.log(json.error);
            error.style.display = "";
            error.innerHTML = `Invalid phone number.`;
          }
        })
        .catch((err) => {
          error.style.display = "";
          error.innerHTML = `Something went wrong: ${err}`;
        });
    }
  </script>
</html>
