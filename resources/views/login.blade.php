<!DOCTYPE html>
<html>
<body>
<img id="pictureUrl">
<p id="userid"></p>
<p id="name"></p>
<button id="btnLogIn" onclick="logIn()">Log In</button>
<button id="btnLogOut" onclick="logOut()">Log Out</button>
<script src="https://static.line-scdn.net/liff/edge/2/sdk.js"></script>
<script>
    function logOut() {
        liff.logout()
        window.location.reload()
    }
    function logIn() {
        liff.login({ redirectUri: window.location.href })
    }
    async function getUserProfile() {
        const profile = await liff.getProfile()
        document.getElementById("pictureUrl").style.display = "block"
        document.getElementById("pictureUrl").src = profile.pictureUrl
        document.getElementById("userid").textContent = profile.userId
        document.getElementById("name").textContent = profile.displayName
    }
    async function main() {
        await liff.init({ liffId: "1657529371-EqPvPz1o" })
        if (liff.isInClient()) {
            getUserProfile()
        } else {
            if (liff.isLoggedIn()) {
                getUserProfile()
                document.getElementById("btnLogIn").style.display = "none"
                document.getElementById("btnLogOut").style.display = "block"
            } else {
                document.getElementById("btnLogIn").style.display = "block"
                document.getElementById("btnLogOut").style.display = "none"
            }
        }
    }
    main()
</script>
</body>
</html>
