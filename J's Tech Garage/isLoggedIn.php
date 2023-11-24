<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Salary and Bonus Calculator</title>
    <style>
        label {
            display: block;
            margin-top: 10px;
        }
        
        .results-container {
            margin-top: 20px;
        }
    </style>
</head>
<body>

    <h2>Employee Information</h2>
    
    <form id="employeeForm">
        <label for="employeeId">Employee ID:</label>
        <input type="text" id="employeeId" required>

        <label for="employeeName">Employee Name:</label>
        <input type="text" id="employeeName" required>

        <label>Gender:</label>
        <input type="radio" id="male" name="gender" value="male" required>
        <label for="male">Male</label>
        <input type="radio" id="female" name="gender" value="female" required>
        <label for="female">Female</label>

        <label for="status">Status:</label>
        <select id="status" required>
            <option value="regular">Regular</option>
            <option value="contractual">Contractual</option>
        </select>

        <label for="hoursWorked">No. of Hours Worked:</label>
        <input type="number" id="hoursWorked" required>

        <label for="ratePerHour">Rate Per Hour:</label>
        <input type="number" id="ratePerHour" required>

        <button type="button" onclick="calculateSalaryAndBonus()">Display</button>
    </form>

    <div class="results-container">
        <h2>Results</h2>
        <label id="resultEmployeeInfo"></label>
        <label id="resultSalary"></label>
        <label id="resultBonus"></label>
    </div>

    <script>
        function calculateSalaryAndBonus() {
            // Get input values
            var employeeId = document.getElementById('employeeId').value;
            var employeeName = document.getElementById('employeeName').value;
            var gender = document.querySelector('input[name="gender"]:checked').value;
            var status = document.getElementById('status').value;
            var hoursWorked = parseFloat(document.getElementById('hoursWorked').value);
            var ratePerHour = parseFloat(document.getElementById('ratePerHour').value);

            // Calculate salary
            var salary = hoursWorked * ratePerHour;

            // Calculate bonus
            var bonus = (salary >= 10000) ? 0.5 * salary : 3000;

            // Display results with employee information using labels
            document.getElementById('resultEmployeeInfo').textContent =
                `Employee ID: ${employeeId}, Employee Name: ${employeeName}, Gender: ${gender}, Status: ${status}, Hours Worked: ${hoursWorked}, Rate Per Hour: ${ratePerHour}`;
            document.getElementById('resultSalary').textContent = 'Salary: ₱' + salary.toFixed(2);
            document.getElementById('resultBonus').textContent = 'Bonus: ₱' + bonus.toFixed(2);
        }
    </script>

</body>
</html>
