<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Feedback Report - UrbanGreen</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
            line-height: 1.6;
            color: #333;
            margin: 20px;
        }
        .header {
            text-align: center;
            margin-bottom: 30px;
            border-bottom: 2px solid #4CAF50;
            padding-bottom: 20px;
        }
        .header h1 {
            color: #4CAF50;
            margin: 0 0 10px 0;
            font-size: 24px;
        }
        .header p {
            margin: 5px 0;
            color: #666;
        }
        .info-section {
            margin-bottom: 20px;
            background: #f9f9f9;
            padding: 15px;
            border-radius: 5px;
        }
        .info-section h3 {
            margin: 0 0 10px 0;
            color: #4CAF50;
            font-size: 16px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        table thead {
            background-color: #4CAF50;
            color: white;
        }
        table th {
            padding: 12px 8px;
            text-align: left;
            font-weight: bold;
            font-size: 11px;
        }
        table td {
            padding: 10px 8px;
            border-bottom: 1px solid #ddd;
            font-size: 11px;
        }
        table tbody tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        table tbody tr:hover {
            background-color: #f5f5f5;
        }
        .rating {
            color: #FFA500;
            font-weight: bold;
        }
        .status-badge {
            padding: 4px 8px;
            border-radius: 3px;
            font-size: 10px;
            font-weight: bold;
            display: inline-block;
        }
        .status-active {
            background-color: #d4edda;
            color: #155724;
        }
        .status-flagged {
            background-color: #fff3cd;
            color: #856404;
        }
        .status-inactive {
            background-color: #f8d7da;
            color: #721c24;
        }
        .footer {
            margin-top: 30px;
            padding-top: 20px;
            border-top: 1px solid #ddd;
            text-align: center;
            font-size: 10px;
            color: #666;
        }
        .summary {
            display: flex;
            justify-content: space-around;
            margin-bottom: 20px;
        }
        .summary-item {
            text-align: center;
            padding: 10px;
        }
        .summary-item .value {
            font-size: 20px;
            font-weight: bold;
            color: #4CAF50;
        }
        .summary-item .label {
            font-size: 11px;
            color: #666;
            margin-top: 5px;
        }
        .no-feedback {
            text-align: center;
            padding: 40px;
            color: #999;
        }

        @media print {
            body {
                margin: 0;
                padding: 15px;
            }
            .no-print {
                display: none !important;
            }
            table {
                page-break-inside: auto;
            }
            tr {
                page-break-inside: avoid;
                page-break-after: auto;
            }
            thead {
                display: table-header-group;
            }
        }

        .print-button {
            position: fixed;
            top: 20px;
            right: 20px;
            padding: 12px 24px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 14px;
            font-weight: bold;
            box-shadow: 0 2px 5px rgba(0,0,0,0.2);
            z-index: 1000;
        }

        .print-button:hover {
            background-color: #45a049;
        }

        .instruction-banner {
            background-color: #fff3cd;
            border: 2px solid #ffc107;
            border-radius: 8px;
            padding: 15px 20px;
            margin: 20px 0;
            text-align: center;
        }

        .instruction-banner h4 {
            color: #856404;
            margin: 0 0 10px 0;
            font-size: 16px;
        }

        .instruction-banner p {
            color: #856404;
            margin: 5px 0;
            font-size: 13px;
        }

        .instruction-banner kbd {
            background-color: #856404;
            color: white;
            padding: 3px 8px;
            border-radius: 3px;
            font-family: monospace;
            font-size: 12px;
        }

        @media print {
            .print-button {
                display: none;
            }
            .instruction-banner {
                display: none;
            }
        }
    </style>
</head>
<body>
    <button onclick="window.print()" class="print-button no-print">📄 Print / Save as PDF</button>

    <div class="instruction-banner no-print">
        <h4>📥 How to Save as PDF</h4>
        <p>Click the button above or press <kbd>Ctrl + P</kbd> (Windows) / <kbd>Cmd + P</kbd> (Mac)</p>
        <p>In the print dialog, select <strong>"Save as PDF"</strong> as the destination, then click <strong>"Save"</strong></p>
    </div>

    <div class="header">
        <h1>UrbanGreen Feedback Report</h1>
        <p>Generated on: <?php echo e(now()->format('F d, Y h:i A')); ?></p>
        <p>Total Records: <?php echo e($feedback->count()); ?></p>
    </div>

    <?php if($feedback->count() > 0): ?>
        <div class="info-section">
            <h3>Summary Statistics</h3>
            <div class="summary">
                <div class="summary-item">
                    <div class="value"><?php echo e($feedback->count()); ?></div>
                    <div class="label">Total Feedback</div>
                </div>
                <div class="summary-item">
                    <div class="value"><?php echo e($feedback->where('status', 'active')->count()); ?></div>
                    <div class="label">Active</div>
                </div>
                <div class="summary-item">
                    <div class="value"><?php echo e($feedback->where('status', 'flagged')->count()); ?></div>
                    <div class="label">Flagged</div>
                </div>
                <div class="summary-item">
                    <div class="value"><?php echo e(number_format($feedback->whereNotNull('rating')->avg('rating'), 1)); ?></div>
                    <div class="label">Avg Rating</div>
                </div>
            </div>
        </div>

        <table>
            <thead>
                <tr>
                    <th style="width: 10%;">User</th>
                    <th style="width: 15%;">Event</th>
                    <th style="width: 35%;">Comment</th>
                    <th style="width: 8%;">Rating</th>
                    <th style="width: 8%;">Likes</th>
                    <th style="width: 12%;">Date</th>
                    <th style="width: 12%;">Status</th>
                </tr>
            </thead>
            <tbody>
                <?php $__currentLoopData = $feedback; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td>
                            <?php if($item->user): ?>
                                <?php echo e($item->user->name); ?>

                            <?php else: ?>
                                Deleted User
                            <?php endif; ?>
                        </td>
                        <td>
                            <?php if($item->event): ?>
                                <?php echo e(Str::limit($item->event->title, 30)); ?>

                            <?php else: ?>
                                Event Deleted
                            <?php endif; ?>
                        </td>
                        <td>
                            <?php echo e(Str::limit($item->comment, 100)); ?>

                        </td>
                        <td class="rating">
                            <?php if($item->rating): ?>
                                <?php echo e($item->rating); ?>/5 ★
                            <?php else: ?>
                                -
                            <?php endif; ?>
                        </td>
                        <td><?php echo e($item->likes_count); ?></td>
                        <td><?php echo e($item->created_at->format('M d, Y')); ?></td>
                        <td>
                            <?php if($item->status === 'active'): ?>
                                <span class="status-badge status-active">Active</span>
                            <?php elseif($item->status === 'flagged'): ?>
                                <span class="status-badge status-flagged">Flagged</span>
                            <?php else: ?>
                                <span class="status-badge status-inactive"><?php echo e(ucfirst($item->status)); ?></span>
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>
    <?php else: ?>
        <div class="no-feedback">
            <p>No feedback records available at this time.</p>
        </div>
    <?php endif; ?>

    <div class="footer">
        <p>&copy; <?php echo e(now()->year); ?> UrbanGreen. All rights reserved.</p>
        <p>This is an automated report generated by the UrbanGreen Admin Dashboard.</p>
    </div>
</body>
</html>
<?php /**PATH E:\Education\Laravel\project\UrbanGreen\resources\views/dashboard/feedback/pdf.blade.php ENDPATH**/ ?>