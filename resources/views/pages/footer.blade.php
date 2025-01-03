<!-- <script>
    // Function to manage the carousel arrows (toggle appearance and behavior)
    function toggleArrows() {
        document.querySelectorAll('.carousel-control-prev, .carousel-control-next').forEach(function(arrow) {
            // Add the black color class
            arrow.classList.add('icon-black');

            // After 2 seconds, hide the arrow
            setTimeout(function() {
                arrow.classList.remove('icon-black'); // Remove the black color
                arrow.classList.add('icon-hidden');  // Make the arrow disappear
            }, 2000);

            // After 3 seconds (total of 5 seconds), show the arrow again
            setTimeout(function() {
                arrow.classList.remove('icon-hidden'); // Show the arrow again
            }, 5000);
        });
    }

    // Call the toggleArrows function every 10 seconds
    setInterval(toggleArrows, 10000); // 10000ms = 10 seconds
</script> -->