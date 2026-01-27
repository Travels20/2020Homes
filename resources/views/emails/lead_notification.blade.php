<!DOCTYPE html>
<html>
<head>
    <title>New Lead Notification</title>
</head>
<body>
    <h2>New Lead Received</h2>
    <p><strong>Source:</strong> {{ $enquiry->source }}</p>
    <p><strong>Mobile:</strong> {{ $enquiry->mobile }}</p>
    <p><strong>Email:</strong> {{ $enquiry->email }}</p>
    <p><strong>Time:</strong> {{ $enquiry->created_at }}</p>
</body>
</html>
