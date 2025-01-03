// var en_types = document.getElementById('en_types');
// en_types.addEventListener('change', tracker);

// function tracker() {
//     const selectedOption = en_types.value;

//     if (selectedOption === "Textbook") {
//         fetch('/lrmis/apacheecharts/grade_subject_population_data.php')
//             .then(response => {
//                 if (!response.ok) {
//                     throw new Error('Network response was not ok');
//                 }
//                 return response.text();
//             })
//             .then(data => {
//                 console.log(data); 
//             })
//             .catch(error => {
//                 console.error('There was a problem with the fetch operation:', error);
//             });
//     }
// }
  // document.getElementById("en_types").addEventListener("change", function() {
  //   var selectedOption = this.value;
  //   if (selectedOption === "Textbook") {
  //     // Replace the PHP code
  //     var newCode = '<?php ob_start(); require_once $_SERVER[\'DOCUMENT_ROOT\'] . \'/lrmis/apacheecharts/textbook_grade_subject_population_data.php\'; $alldata = ob_get_clean(); ?>';
  //     document.querySelector(".scroll-bar").innerHTML = newCode;
  //   } else {
  //     // Replace with the original PHP code
  //     var originalCode = '<?php ob_start(); require_once $_SERVER[\'DOCUMENT_ROOT\'] . \'/lrmis/apacheecharts/grade_subject_population_data.php\'; $alldata = ob_get_clean(); require_once $_SERVER[\'DOCUMENT_ROOT\'] . \'/lrmis/apacheecharts/grade_subject_population_chart.php\'; ?>';
  //     document.querySelector(".scroll-bar").innerHTML = originalCode;
  //   }
  // });
