<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice - Booking Report</title>

    <!-- Inline CSS for PDF Styling -->
    <style>
        body {
            font-family: 'DejaVu Sans', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f8f9fa;
            color: #343a40;
        }

        .container {
            padding: 20px;
            margin: 0 auto;
            width: 90%;
            max-width: 800px;
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h1, h2 {
            text-align: center;
            margin-bottom: 10px;
        }

        .header {
            text-align: center;
            margin-bottom: 30px;
        }

        .details-table, .staff-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        .details-table th, .details-table td,
        .staff-table th, .staff-table td {
            border: 1px solid #ddd;
            padding: 8px;
        }

        .details-table th, .staff-table th {
            background-color: #007bff;
            color: white;
        }

        .text-right {
            text-align: right;
        }

        .text-center {
            text-align: center;
        }

        .staff-image {
            width: 60px;
            height: 60px;
            object-fit: cover;
            border-radius: 50%;
        }

        .footer {
            text-align: center;
            margin-top: 30px;
            font-size: 12px;
            color: #6c757d;
        }
    </style>
</head>
<body>

    <div class="container">
        <div class="header">
            <h1>Booking Invoice</h1>
            <h2>{{ $booking->customer_name }}</h2>
        </div>

        <table class="details-table">
            <tr>
                <th>Customer Name</th>
                <td>{{ $booking->customer_name }}</td>
            </tr>
            <tr>
                <th>Customer Email</th>
                <td>{{ $booking->customer_email }}</td>
            </tr>
            <tr>
                <th>Customer Phone</th>
                <td>{{ $booking->customer_phone }}</td>
            </tr>
            <tr>
                <th>Booking Date</th>
                <td>{{ $booking->appointment_date }}</td>
            </tr>
            <tr>
                <th>Website</th>
                <td>{{ $booking->website->name }}</td>
            </tr>
            <tr>
                <th>Plan</th>
                 <td>{{ $booking->plan->name }}</td>
            </tr>
            <tr>
                <th>Subscription</th>
                 <td>{{ $booking->subscription->name }}</td>
            </tr>
            <tr>
                <th>Category</th>
                 <td>{{ $booking->category->name }}</td>
            </tr>
            <tr>
                <th>Internal Note</th>
                <td>{{ $booking->internal_note }}</td>
            </tr>
        </table>

        <h2 class="text-center">Selected Staff</h2>
        <table class="staff-table">
            <tr>
                <th>Staff Name</th>
                <th>Image</th>
            </tr>
            <tr>
                <td>{{ $booking->staff->first_name }} {{ $booking->staff->last_name }}</td>
                <td class="text-center">
                    <img src="{{ public_path($booking->staff->image) }}" class="staff-image" alt="Staff Image">
                </td>
            </tr>
        </table>

        <div class="footer">
            <p>Thank you for booking with {{ $name }}!</p>
        </div>
    </div>

</body>
</html>
