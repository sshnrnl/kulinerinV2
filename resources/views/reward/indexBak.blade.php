<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reward Redemption</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/js/all.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <style>
        :root {
            --primary-color: #4f46e5;
            --secondary-color: #8b5cf6;
            --success-color: #10b981;
            --danger-color: #ef4444;
            --warning-color: #f59e0b;
            --light-bg: #f3f4f6;
            --card-bg: #ffffff;
            --text-primary: #1f2937;
            --text-secondary: #6b7280;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        body {
            background-color: var(--light-bg);
            color: var(--text-primary);
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
        }

        .header h1 {
            color: var(--primary-color);
            font-size: 24px;
        }

        .user-points {
            display: flex;
            align-items: center;
            padding: 8px 15px;
            background-color: var(--primary-color);
            color: white;
            border-radius: 20px;
            font-weight: bold;
        }

        .user-points i {
            margin-right: 8px;
        }

        .filters {
            display: flex;
            justify-content: space-between;
            margin-bottom: 20px;
            flex-wrap: wrap;
            gap: 10px;
        }

        .filter-group {
            display: flex;
            gap: 10px;
        }

        .filter-btn {
            padding: 8px 15px;
            background-color: var(--card-bg);
            border: 1px solid #ddd;
            border-radius: 20px;
            cursor: pointer;
            transition: all 0.3s;
        }

        .filter-btn.active {
            background-color: var(--primary-color);
            color: white;
            border-color: var(--primary-color);
        }

        .search-bar {
            position: relative;
        }

        .search-bar input {
            padding: 8px 15px;
            padding-left: 40px;
            border-radius: 20px;
            border: 1px solid #ddd;
            width: 250px;
        }

        .search-bar i {
            position: absolute;
            left: 15px;
            top: 10px;
            color: var(--text-secondary);
        }

        .rewards-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }

        .reward-card {
            background-color: var(--card-bg);
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
            transition: transform 0.3s;
        }

        .reward-card:hover {
            transform: translateY(-5px);
        }

        .reward-image {
            height: 180px;
            background-size: cover;
            background-position: center;
            position: relative;
        }

        .reward-category {
            position: absolute;
            top: 10px;
            left: 10px;
            background-color: rgba(0, 0, 0, 0.6);
            color: white;
            padding: 5px 10px;
            border-radius: 15px;
            font-size: 12px;
        }

        .reward-stock {
            position: absolute;
            top: 10px;
            right: 10px;
            background-color: rgba(0, 0, 0, 0.6);
            color: white;
            padding: 5px 10px;
            border-radius: 15px;
            font-size: 12px;
        }

        .reward-details {
            padding: 15px;
        }

        .reward-name {
            font-weight: bold;
            margin-bottom: 5px;
            font-size: 18px;
        }

        .reward-description {
            color: var(--text-secondary);
            font-size: 14px;
            margin-bottom: 15px;
            height: 60px;
            overflow: hidden;
            text-overflow: ellipsis;
            display: -webkit-box;
            -webkit-line-clamp: 3;
            -webkit-box-orient: vertical;
        }

        .reward-footer {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px 15px;
            background-color: #f9fafb;
            border-top: 1px solid #eee;
        }

        .reward-points {
            font-weight: bold;
            color: var(--primary-color);
            display: flex;
            align-items: center;
        }

        .reward-points i {
            margin-right: 5px;
        }

        .redeem-btn {
            padding: 6px 12px;
            background-color: var(--primary-color);
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .redeem-btn:hover {
            background-color: var(--secondary-color);
        }

        .redeem-btn:disabled {
            background-color: var(--text-secondary);
            cursor: not-allowed;
        }

        /* Modal styles */
        .modal {
            display: none;
            position: fixed;
            z-index: 100;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            align-items: center;
            justify-content: center;
        }

        .modal-content {
            background-color: var(--card-bg);
            border-radius: 10px;
            width: 90%;
            max-width: 500px;
            position: relative;
            animation: modalopen 0.4s;
        }

        .modal-header {
            padding: 15px 20px;
            border-bottom: 1px solid #eee;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .modal-header h2 {
            font-size: 20px;
            color: var(--primary-color);
        }

        .close-modal {
            cursor: pointer;
            font-size: 22px;
            font-weight: bold;
            color: var(--text-secondary);
        }

        .modal-body {
            padding: 20px;
        }

        .modal-footer {
            padding: 15px 20px;
            border-top: 1px solid #eee;
            text-align: right;
        }

        .confirmation-details {
            display: flex;
            flex-direction: column;
            gap: 15px;
            margin-bottom: 20px;
        }

        .detail-item {
            display: flex;
            justify-content: space-between;
        }

        .detail-label {
            color: var(--text-secondary);
        }

        .detail-value {
            font-weight: bold;
        }

        .confirm-btn {
            padding: 8px 20px;
            background-color: var(--success-color);
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            margin-left: 10px;
        }

        .cancel-btn {
            padding: 8px 20px;
            background-color: #f3f4f6;
            color: var(--text-secondary);
            border: 1px solid #ddd;
            border-radius: 5px;
            cursor: pointer;
        }

        /* Success modal */
        .success-icon {
            font-size: 60px;
            color: var(--success-color);
            text-align: center;
            margin: 20px 0;
        }

        .success-message {
            text-align: center;
            margin-bottom: 15px;
        }

        .code-container {
            background-color: #f3f4f6;
            padding: 15px;
            border-radius: 5px;
            text-align: center;
            margin: 20px 0;
        }

        .redemption-code {
            font-size: 24px;
            font-weight: bold;
            letter-spacing: 2px;
            color: var(--primary-color);
        }

        .history-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 30px;
        }

        .history-table th,
        .history-table td {
            padding: 12px 15px;
            text-align: left;
            border-bottom: 1px solid #eee;
        }

        .history-table th {
            background-color: #f9fafb;
            font-weight: bold;
            color: var(--text-secondary);
        }

        .status-pending {
            background-color: var(--warning-color);
            color: white;
            padding: 3px 10px;
            border-radius: 20px;
            font-size: 12px;
            display: inline-block;
        }

        .status-completed {
            background-color: var(--success-color);
            color: white;
            padding: 3px 10px;
            border-radius: 20px;
            font-size: 12px;
            display: inline-block;
        }

        .status-cancelled {
            background-color: var(--danger-color);
            color: white;
            padding: 3px 10px;
            border-radius: 20px;
            font-size: 12px;
            display: inline-block;
        }

        .tabs {
            display: flex;
            margin-bottom: 20px;
            border-bottom: 1px solid #ddd;
        }

        .tab {
            padding: 12px 20px;
            cursor: pointer;
            position: relative;
        }

        .tab.active {
            color: var(--primary-color);
            font-weight: bold;
        }

        .tab.active::after {
            content: '';
            position: absolute;
            bottom: -1px;
            left: 0;
            width: 100%;
            height: 3px;
            background-color: var(--primary-color);
        }

        .tab-content {
            display: none;
        }

        .tab-content.active {
            display: block;
        }

        @keyframes modalopen {
            from {
                opacity: 0;
                transform: translateY(-50px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @media (max-width: 768px) {
            .filters {
                flex-direction: column;
            }

            .search-bar input {
                width: 100%;
            }

            .rewards-grid {
                grid-template-columns: repeat(auto-fill, minmax(240px, 1fr));
            }
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            <h1>Reward Redemption</h1>
            <div class="user-points">
                <i class="fas fa-coins"></i>
                <span>Your Points: <span id="userPoints">1,500</span></span>
            </div>
        </div>

        <div class="tabs">
            <div class="tab active" data-tab="rewards">Available Rewards</div>
            <div class="tab" data-tab="history">Redemption History</div>
        </div>

        <div id="rewards-tab" class="tab-content active">
            <div class="filters">
                <div class="filter-group">
                    <button class="filter-btn active" data-category="all">All</button>
                    <button class="filter-btn" data-category="voucher">Vouchers</button>
                    <button class="filter-btn" data-category="product">Products</button>
                    <button class="filter-btn" data-category="service">Services</button>
                </div>

                <div class="search-bar">
                    <i class="fas fa-search"></i>
                    <input type="text" placeholder="Search rewards...">
                </div>
            </div>

            <div class="rewards-grid">
                <div class="reward-card" data-category="voucher">
                    <div class="reward-image" style="background-image: url('/api/placeholder/280/180');">
                        <span class="reward-category">Voucher</span>
                        <span class="reward-stock">Stock: 15</span>
                    </div>
                    <div class="reward-details">
                        <h3 class="reward-name">$10 Amazon Gift Card</h3>
                        <p class="reward-description">Redeem this voucher for $10 credit on Amazon. Valid for 12 months
                            from date of issue.</p>
                    </div>
                    <div class="reward-footer">
                        <div class="reward-points">
                            <i class="fas fa-coins"></i>
                            <span>500 points</span>
                        </div>
                        <button class="redeem-btn" data-id="1" data-name="$10 Amazon Gift Card"
                            data-points="500">Redeem</button>
                    </div>
                </div>

                <div class="reward-card" data-category="product">
                    <div class="reward-image" style="background-image: url('/api/placeholder/280/180');">
                        <span class="reward-category">Product</span>
                        <span class="reward-stock">Stock: 8</span>
                    </div>
                    <div class="reward-details">
                        <h3 class="reward-name">Bluetooth Headphones</h3>
                        <p class="reward-description">High-quality wireless headphones with noise cancellation and
                            20-hour battery life.</p>
                    </div>
