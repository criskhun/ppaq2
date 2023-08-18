
<script>

    function updateTimer() {
            const startTime = <?php echo time() * 1000; ?>; // Convert PHP time to milliseconds
            const timerInput = document.getElementById("duration");

            function formatTime(time) {
                const hours = Math.floor(time / 3600000);
                const minutes = Math.floor((time % 3600000) / 60000);
                const seconds = Math.floor((time % 60000) / 1000);

                const formattedHours = hours.toString().padStart(2, '0');
                const formattedMinutes = minutes.toString().padStart(2, '0');
                const formattedSeconds = seconds.toString().padStart(2, '0');

                return `${formattedHours} : ${formattedMinutes} : ${formattedSeconds}`;
            }

            setInterval(() => {
                const currentTime = new Date().getTime();
                const elapsedMilliseconds = currentTime - startTime;
                const formattedTime = formatTime(elapsedMilliseconds);
                timerInput.value = formattedTime;
            }, 1000);
        }
        
        updateTimer();

            // Toggle Combo Box
    mySwitchTransfer1 = document.getElementById("mySwitchTrans");
    selectContainer = document.getElementById("selectContainer");
    selectContainer2 = document.getElementById("selectContainer2");

    mySwitchTransfer1.addEventListener("change", function() {
        if (mySwitchTransfer1.checked) {
            selectContainer.style.display = "block";
            selectContainer2.style.display = "none";
        } else {
            selectContainer.style.display = "none";
            selectContainer2.style.display = "block";
        }
    });
</script>

</body>
</html>
