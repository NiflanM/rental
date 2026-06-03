<form action="{{ route('bookings.update', $booking->id) }}"
      method="POST"
      class="max-w-2xl mx-auto p-8 bg-white rounded-2xl shadow space-y-6">

    @csrf
    @method('PUT')

    <h1 class="text-3xl font-bold">
        Edit Booking
    </h1>

    <div>
        <label>Customer Name</label>

        <input type="text"
               name="customer_name"
               value="{{ old('customer_name', $booking->customer_name) }}"
               class="w-full border rounded-xl p-3">
    </div>

    <div>
        <label>Email</label>

        <input type="email"
               name="email"
               value="{{ old('email', $booking->email) }}"
               class="w-full border rounded-xl p-3">
    </div>

    <div>
        <label>Phone</label>

        <input type="text"
               name="phone"
               value="{{ old('phone', $booking->phone) }}"
               class="w-full border rounded-xl p-3">
    </div>

    <div>
        <label>Car</label>

        <select name="car_id"
                class="w-full border rounded-xl p-3">

            @foreach($cars as $car)

            <option value="{{ $car->id }}"
                {{ $booking->car_id == $car->id ? 'selected' : '' }}>

                {{ $car->name }}

            </option>

            @endforeach

        </select>
    </div>

    <div class="grid grid-cols-2 gap-4">

        <div>
            <label>Start Date</label>

            <input type="date"
                   name="start_date"
                   value="{{ old('start_date', $booking->start_date) }}"
                   class="w-full border rounded-xl p-3">
        </div>

        <div>
            <label>End Date</label>

            <input type="date"
                   name="end_date"
                   value="{{ old('end_date', $booking->end_date) }}"
                   class="w-full border rounded-xl p-3">
        </div>

    </div>

    <div>
        <label>Status</label>

        <select name="status"
                class="w-full border rounded-xl p-3">

            <option value="pending"
                {{ $booking->status == 'pending' ? 'selected' : '' }}>
                Pending
            </option>

            <option value="approved"
                {{ $booking->status == 'approved' ? 'selected' : '' }}>
                Approved
            </option>

            <option value="hold"
                {{ $booking->status == 'hold' ? 'selected' : '' }}>
                Hold
            </option>

            <option value="rejected"
                {{ $booking->status == 'rejected' ? 'selected' : '' }}>
                Rejected
            </option>

        </select>
    </div>

    <div>
        <label>Notes</label>

        <textarea name="notes"
                  class="w-full border rounded-xl p-3"
                  rows="4">{{ old('notes', $booking->notes) }}</textarea>
    </div>

    <button class="w-full bg-indigo-600 hover:bg-indigo-700
                   text-white py-4 rounded-xl font-semibold">

        Update Booking

    </button>

</form>