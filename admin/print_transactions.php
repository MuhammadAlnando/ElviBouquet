<?php
require 'partials/_dbconnect.php';

$period = isset($_GET['period']) ? $_GET['period'] : 'today';

// Mendapatkan tanggal untuk periode yang dipilih
switch ($period) {
    case 'week':
        $start_date = date('Y-m-d', strtotime('monday this week'));
        $end_date = date('Y-m-d', strtotime('sunday this week'));
        break;
    case 'month':
        $start_date = date('Y-m-01');
        $end_date = date('Y-m-t');
        break;
    case 'year':
        $start_date = date('Y-01-01');
        $end_date = date('Y-12-31');
        break;
    case 'today':
    default:
        $start_date = date('Y-m-d');
        $end_date = date('Y-m-d');
        break;
}

$sql = "
    SELECT * FROM orders 
    WHERE orderDate BETWEEN '$start_date' AND '$end_date' 
    AND orderStatus IN (1, 2, 3, 4)
";
$result = mysqli_query($conn, $sql);
if (!$result) {
    die('Error: ' . mysqli_error($conn));
}

// Define delivery charges based on delivery method
$deliveryCharges = [
    'deliverybatamkota' => 20000,
    'deliverybatuaji' => 20000,
    'deliverybatuampar' => 15000,
    'deliverybengkong' => 15000,
    'deliverylubukbaja' => 15000,
    'deliverynongsa' => 25000,
    'deliverysagulung' => 20000,
    'deliveryseibeduk' => 20000,
    'deliverysekupang' => 10000,
];

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Print Transactions</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.2/html2pdf.bundle.min.js"></script>
    <style>
    @media print {
        .no-print {
            display: none;
        }
    }
</style>

</head>
<body>
<div class="container mt-4" id="reportContent">
    <h3 class="text-center">Report Transactions</h3>
    <h5>Elvi Bouquet</h5>
    <p>Print Date: <?php echo $start_date; ?> to <?php echo $end_date; ?></p>
    <p>Perumahan Cluster Melati Recidence, Blok F #11. Tiban - Sekupang. Kota Batam</p>
    <table class="table table-bordered mt-4">
        <thead>
            <tr>
                <th>No</th>
                <th>Order ID</th>
                <th>Order Date</th>
                <th>Amount</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $count = 1;
            $totalAmount = 0;
            while ($row = mysqli_fetch_assoc($result)) {
                $amount = $row['amount'];
                $deliveryMethod = $row['deliveryMethod'];
                
                if (array_key_exists($deliveryMethod, $deliveryCharges)) {
                    $amount += $deliveryCharges[$deliveryMethod];
                }
                
                $totalAmount += $amount;
                echo "<tr>
                    <td>{$count}</td>
                    <td>{$row['orderId']}</td>
                    <td>{$row['orderDate']}</td>
                    <td>Rp. " . number_format($amount, 2) . "</td>
                </tr>";
                $count++;
            }
            ?>
        </tbody>
        <tfoot>
            <tr>
                <th colspan="3" class="text-right">Total:</th>
                <th>Rp. <?php echo number_format($totalAmount, 2); ?></th>
            </tr>
        </tfoot>
    </table>
    <div class="text-center no-print">
    <button class="btn btn-primary no-print" onclick="generatePDF()">Download</button>
    <!-- <a href="index.php" class="btn btn-secondary no-print">Back to Admin Page</a> -->
</div>

</div>

<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
<script>
    function generatePDF() {
        const element = document.getElementById('reportContent');
        html2pdf()
            .from(element)
            .set({
                margin: 1,
                filename: 'ReportTransactions.pdf',
                html2canvas: {
                    scale: 2,
                    ignoreElements: function (element) {
                        return element.classList.contains('no-print');
                    }
                },
                jsPDF: {
                    unit: 'in',
                    format: 'letter',
                    orientation: 'portrait'
                }
            })
            .toPdf()
            .get('pdf')
            .then(function (pdf) {
                const url = pdf.output('bloburl');
                window.open(url, '_blank');
            });
    }
</script>

</body>
</html>
