<script src="../javascript/cookies.js"></script>

<!-- The Modal -->
<div id="myModal" class="modal">

  <!-- Modal content -->
  <div class="modal-content">
    <div class="modal-header">
      <span class="close">&times;</span>
      <h2>Cookie policy</h2>
    </div>
    <div class="modal-body">
      <p>This website uses cookies.</p>
      <p>These cookies are used to collect information about how you interact 
      with our website and allow us to remember you. If you decline, 
      your information won’t be tracked when you visit this website. 
      A single cookie will be used in your browser to remember your preference not to be tracked.</p>
    </div>
    <div class="modal-footer">
      <button value="Accept" id="acceptButton">Accept</button>
      <button value="Decline" id="declineButton">Decline</button>
    </div>
  </div>

</div>

<script>

    var modal = document.getElementById("myModal");
    var close = document.getElementsByClassName("close")[0];
    var acceptButton = document.getElementById("acceptButton");
    var declineButton = document.getElementById("declineButton");
    var cookieUser;
    var checkPage;

    function showModal() {
        cookieUser = getCookie("user");
        if (performance.navigation.type == 1 || !empty(cookieUser)) {
          modal.style.display = "none";
        } else {
          modal.style.display = "block";
        }
    }

    close.onclick = function() {
    modal.style.display = "none";
    }

    acceptButton.onclick = function() {
      modal.style.display = "none";
      setCookie("user", "accept", 0);
    }

    declineButton.onclick = function() {
      modal.style.display = "none";
      setCookie("user", "decline", 0);
      
    }

</script>

<style>
/* The Modal (background) */
.modal {
    display: none; /* Hidden by default */
    position: fixed; /* Stay in place */
    z-index: 1; /* Sit on top */
    left: 0;
    top: 0;
    width: 100%; /* Full width */
    height: 100%; /* Full height */
    overflow: auto; /* Enable scroll if needed */
    background-color: rgb(0,0,0); /* Fallback color */
    background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
    -webkit-animation-name: fadeIn; /* Fade in the background */
    -webkit-animation-duration: 0.4s;
    animation-name: fadeIn;
    animation-duration: 0.4s
  }
  
  /* Modal Content */
  .modal-content {
    position: fixed;
    bottom: 0;
    background-color: #fefefe;
    width: 100%;
    -webkit-animation-name: slideIn;
    -webkit-animation-duration: 0.4s;
    animation-name: slideIn;
    animation-duration: 0.4s
  }
  
  /* The Close Button */
  .close {
    color: white;
    float: right;
    font-size: 28px;
    font-weight: bold;
  }
  
  .close:hover,
  .close:focus {
    color: #000;
    text-decoration: none;
    cursor: pointer;
  }
  
  .modal-header {
    padding: 2px 16px;
    background-color: #5cb85c;
    color: white;
  }
  
  .modal-body {padding: 2px 16px;}
  
  .modal-footer {
    padding: 2px 16px;
    background-color: #5cb85c;
    color: white;
  }
  
  /* Add Animation */
  @-webkit-keyframes slideIn {
    from {bottom: -300px; opacity: 0} 
    to {bottom: 0; opacity: 1}
  }
  
  @keyframes slideIn {
    from {bottom: -300px; opacity: 0}
    to {bottom: 0; opacity: 1}
  }
  
  @-webkit-keyframes fadeIn {
    from {opacity: 0} 
    to {opacity: 1}
  }
  
  @keyframes fadeIn {
    from {opacity: 0} 
    to {opacity: 1}
  }

  </style>