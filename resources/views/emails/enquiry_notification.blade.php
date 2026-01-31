@component('mail::message')
# New Enquiry Received

Hello,

A new enquiry has been submitted on **2020Homes**. Here are the details:

**Customer Information:**
- **Name:** {{ $enquiry->name }}
- **Email:** {{ $enquiry->email }}
- **Phone:** {{ $enquiry->phone }}

**Request Details:**
- **Preferred Date:** {{ $enquiry->preferred_date->format('d M Y') }}
- **Source:** {{ ucfirst(str_replace('_', ' ', $enquiry->source)) }}
- **Status:** {{ $enquiry->status == 1 ? 'New' : 'Reviewed' }}

@if($enquiry->message)
**Message:**
{{ $enquiry->message }}
@endif

**Submitted On:** {{ $enquiry->created_at->format('d M Y H:i A') }}

---

@component('mail::button', ['url' => route('admin.enquiries.index')])
View Enquiry
@endcomponent

Thank you,
**2020Homes Team**
@endcomponent
