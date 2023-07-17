 // Reset button clear all on click

 

 const resetButton = document.querySelector('#reset');
 const inputFields = document.querySelectorAll('input');

 resetButton.addEventListener('click', () => {
 inputFields.forEach((input) => {
     input.value = '';
 });
 });

//Display Only Date till today //

var dtToday = new Date();
var month = dtToday.getMonth() + 1;     // getMonth() is zero-based
var day = dtToday.getDate();
var year = dtToday.getFullYear();
if(month < 10)
   month = '0' + month.toString();
if(day < 10)
   day = '0' + day.toString();

var maxDate = year + '-' + month + '-' + day;
$('#month').attr('max', maxDate);


 $(document).ready(function() {
     // Open the database
     var db = openDatabase('mydb', '1.0', 'My Database', 2 * 1024 * 1024);
   
     // Create the table if it does not exist
     db.transaction(function(tx) {
       tx.executeSql('CREATE TABLE IF NOT EXISTS users (id INTEGER PRIMARY KEY, month TEXT, salary TEXT, necessity TEXT, financial TEXT, education TEXT, longterm TEXT, entertainment TEXT, give TEXT)');
     });
   
     // Handle the form submission
     $("#register_form").on("submit", function(event) {
       event.preventDefault();
       if (this.checkValidity()) {

            var month = $("#month").val();
            var salaryInput = $("#salary").val();

            const salary = parseFloat(salaryInput).toFixed(2);;
            const necessity = (salary * 0.55).toFixed(2);
            const financial = (salary * 0.1).toFixed(2);
            const education = (salary * 0.1).toFixed(2);
            const longTerm = (salary * 0.1).toFixed(2);
            const entertainment = (salary * 0.1).toFixed(2);
            const give = (salary * 0.05).toFixed(2);

        
   
         // Insert the user into the database
         db.transaction(function(tx) {
           tx.executeSql('INSERT INTO users (month, salary, necessity, financial, education, longterm, entertainment, give) VALUES (?, ?, ?, ?, ?, ?, ?, ?)', [month, salary, necessity, financial, education, longTerm, entertainment, give], function(tx, results) {
      
             // Redirect to the display page
             window.location.href = 'salary.html';
             
           }, function(tx, error) {
             alert("Error: " + error.message);
           });
         });
       }
       $(this).addClass('was-validated');
     });
   });