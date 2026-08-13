<?php

$bill = 0;
$units = "";
$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $units = (float)$_POST["units"];

    if ($units < 0) {
        $error = "Please enter a valid number of units.";
    }

    elseif ($units <= 50) {
        $bill = $units * 3.50;
    }

    elseif ($units <= 150) {
        $bill = (50 * 3.50) + (($units - 50) * 4.00);
    }

    elseif ($units <= 250) {
        $bill = (50 * 3.50)
              + (100 * 4.00)
              + (($units - 150) * 5.20);
    }

    else {
        $bill = (50 * 3.50)
              + (100 * 4.00)
              + (100 * 5.20)
              + (($units - 250) * 6.50);
    }
}

?>

<!DOCTYPE html>

<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Electricity Bill Calculator</title>

    <style>

        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: Arial, sans-serif;

            background: linear-gradient(
                135deg,
                #dbeafe,
                #eff6ff
            );

            min-height: 100vh;

            display: flex;
            justify-content: center;
            align-items: center;

            padding: 25px;
        }

        .container {
            width: 100%;
            max-width: 500px;

            background: white;

            padding: 30px;

            border-radius: 18px;

            box-shadow:
                0 10px 30px
                rgba(0, 0, 0, 0.12);
        }

        .header {
            text-align: center;

            margin-bottom: 25px;
        }

        .icon {
            font-size: 42px;
        }

        h1 {
            margin: 8px 0;

            color: #1e3a8a;

            font-size: 30px;
        }

        .description {
            color: #64748b;

            font-size: 14px;

            line-height: 1.5;
        }

        label {
            display: block;

            margin-bottom: 8px;

            font-weight: bold;

            color: #1e293b;
        }

        input {
            width: 100%;

            padding: 13px;

            border: 1px solid #cbd5e1;

            border-radius: 8px;

            font-size: 16px;

            outline: none;
        }

        input:focus {
            border-color: #2563eb;
        }

        button {
            width: 100%;

            margin-top: 16px;

            padding: 13px;

            border: none;

            border-radius: 8px;

            background: #2563eb;

            color: white;

            font-size: 16px;

            cursor: pointer;
        }

        button:hover {
            background: #1d4ed8;
        }

        .result {
            margin-top: 25px;

            padding: 20px;

            background: #eff6ff;

            border-radius: 12px;

            text-align: center;

            border: 1px solid #dbeafe;
        }

        .result-title {
            font-size: 13px;

            color: #64748b;

            text-transform: uppercase;

            letter-spacing: 1px;
        }

        .units {
            margin: 8px 0 15px;

            font-size: 18px;

            color: #1e293b;
        }

        .bill {
            font-size: 28px;

            font-weight: bold;

            color: #1e40af;
        }

        .error {
            margin-top: 15px;

            padding: 10px;

            background: #fee2e2;

            color: #b91c1c;

            border-radius: 8px;

            text-align: center;
        }

        .tariff {
            margin-top: 25px;
        }

        .tariff h2 {
            font-size: 18px;

            color: #1e293b;

            margin-bottom: 12px;
        }

        .tariff-row {
            display: flex;

            justify-content: space-between;

            padding: 10px 12px;

            border-bottom: 1px solid #e2e8f0;

            font-size: 14px;
        }

        .tariff-row:last-child {
            border-bottom: none;
        }

        .rate {
            font-weight: bold;

            color: #2563eb;
        }

        .footer {
            text-align: center;

            margin-top: 25px;

            font-size: 12px;

            color: #94a3b8;
        }

        @media (max-width: 500px) {

            body {
                padding: 15px;
            }

            .container {
                padding: 22px;
            }

            h1 {
                font-size: 25px;
            }

            .bill {
                font-size: 24px;
            }

            .tariff-row {
                font-size: 13px;
            }
        }

    </style>

</head>

<body>

    <div class="container">

        <div class="header">

            <div class="icon">⚡</div>

            <h1>
                Electricity Bill Calculator
            </h1>

            <p class="description">
                Calculate your electricity bill based on
                the applicable unit-wise tariff slabs.
            </p>

        </div>


        <form method="POST">

            <label for="units">
                Enter Units Consumed
            </label>

            <input
                type="number"
                name="units"
                id="units"
                min="0"
                step="0.01"
                placeholder="Enter units"
                value="<?php echo htmlspecialchars($units); ?>"
                required
            >

            <button type="submit">
                Calculate Bill
            </button>

        </form>


        <?php if ($error != ""): ?>

            <div class="error">

                <?php echo $error; ?>

            </div>

        <?php elseif ($_SERVER["REQUEST_METHOD"] == "POST"): ?>

            <div class="result">

                <div class="result-title">
                    Bill Summary
                </div>

                <div class="units">

                    Units Consumed:
                    <strong>
                        <?php echo $units; ?>
                    </strong>

                </div>

                <div class="bill">

                    Rs. <?php echo number_format($bill, 2); ?>

                </div>

            </div>

        <?php endif; ?>


        <div class="tariff">

            <h2>
                Electricity Tariff Slabs
            </h2>

            <div class="tariff-row">

                <span>First 50 units</span>

                <span class="rate">
                    Rs. 3.50/unit
                </span>

            </div>

            <div class="tariff-row">

                <span>Next 100 units</span>

                <span class="rate">
                    Rs. 4.00/unit
                </span>

            </div>

            <div class="tariff-row">

                <span>Next 100 units</span>

                <span class="rate">
                    Rs. 5.20/unit
                </span>

            </div>

            <div class="tariff-row">

                <span>Above 250 units</span>

                <span class="rate">
                    Rs. 6.50/unit
                </span>

            </div>

        </div>


        <div class="footer">

            Web Technologies Project • PHP

        </div>

    </div>

</body>

</html>