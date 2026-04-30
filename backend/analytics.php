<?php
require_once 'db.php';

$action = $_GET['action'] ?? 'getStats';

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    if ($action === 'getStats') {
        try {
            // 1. Monthly Revenue
            $stmtRev = $pdo->query("SELECT DATE_FORMAT(date, '%Y-%m') as month, SUM(total + IFNULL(extra_charge, 0)) as revenue FROM orders WHERE payment_status = 'Paid' AND status != 'Cancelled' GROUP BY month ORDER BY month");
            $revenueData = $stmtRev->fetchAll();

            // 2. Best Sellers
            $stmtBest = $pdo->query("SELECT p.name, SUM(oi.qty) as units_sold FROM order_items oi JOIN products p ON oi.product_id = p.id JOIN orders o ON oi.order_id = o.id WHERE o.status != 'Cancelled' GROUP BY p.id ORDER BY units_sold DESC LIMIT 5");
            $bestSellers = $stmtBest->fetchAll();

            // 3. Order Status Breakdown
            $stmtStatus = $pdo->query("SELECT status, COUNT(*) as count FROM orders GROUP BY status");
            $statusBreakdown = $stmtStatus->fetchAll();

            sendJSON([
                'success' => true,
                'revenue' => $revenueData,
                'bestSellers' => $bestSellers,
                'statusBreakdown' => $statusBreakdown
            ]);
        } catch (Exception $e) {
            sendJSON(['error' => 'Failed to fetch analytics: ' . $e->getMessage()], 500);
        }
    }
}

sendJSON(['error' => 'Invalid request.'], 400);
?>
