<?php

session_start();

// Initialize an empty array to store expenses
if (!isset($_SESSION['expenses'])) {
    $_SESSION['expenses'] = [];
}

// Function to add an expense
function addExpense($name, $amount) {
    $_SESSION['expenses'][] = ['name' => $name, 'amount' => $amount];
}

// Function to calculate total expenses
function calculateTotalExpenses() {
    $total = 0;
    foreach ($_SESSION['expenses'] as $expense) {
        $total += $expense['amount'];
    }
    return $total;
}

// Example usage:
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Assuming you are sending data via a form
    if (isset($_POST['expense_name']) && isset($_POST['expense_amount'])) {
        $name = $_POST['expense_name'];
        $amount = $_POST['expense_amount'];
        addExpense($name, $amount);
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Personal Finance Management</title>
</head>
<body>
    <h1>Personal Finance Management</h1>

    <h2>Add Expense</h2>
    <form method="post">
        <label for="expense_name">Expense Name:</label>
        <input type="text" id="expense_name" name="expense_name" required><br><br>
        <label for="expense_amount">Amount:</label>
        <input type="number" id="expense_amount" name="expense_amount" required><br><br>
        <button type="submit">Add Expense</button>
    </form>

    <h2>Expenses</h2>
    <ul>
        <?php foreach ($_SESSION['expenses'] as $expense): ?>
            <li><?php echo $expense['name']; ?> - $<?php echo $expense['amount']; ?></li>
        <?php endforeach; ?>
    </ul>

    <h2>Total Expenses: $<?php echo calculateTotalExpenses(); ?></h2>
</body>
</html>
