<?php

ini_set('display_errors', 1);
error_reporting(E_ALL);

require_once 'vendor/autoload.php';

use FactoryMethod\Plans\MonthlyPlan;
use FactoryMethod\Plans\QuarterPlan;
use FactoryMethod\Plans\YearlyPlan;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $planType = $_POST['plan_type'];
    $periodId = $_POST['period_id'];
    $startDate = $_POST['start_date'];

    $plan = null;

    switch ($planType) {
        case 'monthly':
            $plan = new MonthlyPlan();
            break;
        case 'quarter':
            $plan = new QuarterPlan();
            break;
        case 'yearly':
            $plan = new YearlyPlan();
            break;
        default:
            echo "Invalid plan type!";
            exit;
    }

    try {
        $period = $plan->getPeriod($periodId, $startDate);
        $price = $period->calculatePrice();
        $endDate = $period->setEndDate();
        echo "Price: " . $price . " | End Date: " . $endDate;
    } catch (\Exception $e) {
        echo "Error: " . $e->getMessage();
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Factory Method - Plan Selection</title>
</head>
<body>
    <h1>Select a Plan</h1>
    <form method="POST" action="">
        <label for="plan_type">Choose a plan type:</label>
        <select name="plan_type" id="plan_type">
            <option value="monthly">Monthly</option>
            <option value="quarter">Quarterly</option>
            <option value="yearly">Yearly</option>
        </select>

        <br><br>

        <label for="period_id">Choose a period:</label>
        <select name="period_id" id="period_id">
            <!-- The options will change based on the plan type -->
            <option value="1">Once a Week</option>
            <option value="2">Twice a Week</option>
            <option value="3">Twice a Month</option>
            <option value="4">Once a Month</option>
            <option value="5">Once Every Two Months</option>
        </select>

        <br><br>

        <label for="start_date">Start Date:</label>
        <input type="date" name="start_date" id="start_date" required>

        <br><br>

        <button type="submit">Calculate</button>
    </form>
</body>
</html>
