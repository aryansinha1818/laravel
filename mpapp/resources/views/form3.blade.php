<link rel="stylesheet" href="{{ asset('css/form2.css') }}">

<div class="form-container">

    <h2>Form3 - Full Validation</h2>

    <!-- all error in one go -->
    <!-- {{ print_r($errors) }} -->

    <!-- all errors and then match it to them and color red. but all in the above. but we want above each field -->
    <!-- @if($errors->any())
    @foreach($errors->all() as $error)
    <div style=" color: red;">
        {{ $error }}
    </div>
    @endforeach
    @endif -->

    @if(session('success'))
    <div class="success">{{ session('success') }}</div>
    @endif

    @if($errors->any())
    <div class="error-box">
        @foreach($errors->all() as $error)
        <p class="error">{{ $error }}</p>
        @endforeach
    </div>
    @endif

    <form action="/form3" method="POST">
        @csrf

        <!-- NAME -->
        <label>Name (UPPERCASE only)</label>
        <input type="text" name="name" value="{{ old('name') }}">
        @error('name') <p class="error">{{ $message }}</p> @enderror

        <!-- EMAIL -->
        <label>Email</label>
        <input type="email" name="email" value="{{ old('email') }}">
        @error('email') <p class="error">{{ $message }}</p> @enderror

        <!-- PASSWORD -->
        <label>Password</label>
        <input type="password" name="password" value="{{ old('password')     }}">
        @error('password') <p class="error">{{ $message }}</p> @enderror

        <!-- CONTACT METHOD -->
        <label>Contact Method</label>
        <select name="contact_method">
            <option value="">Select</option>
            <option value="email" {{ old('contact_method')=='email' ? 'selected' : '' }}>Email</option>
            <option value="phone" {{ old('contact_method')=='phone' ? 'selected' : '' }}>Phone</option>
        </select>

        <!-- PHONE (conditional) -->
        <label>Phone</label>
        <!-- old kaunse value ki? form! -->
        <input type="text" name="phone" value="{{ old('phone') }}">
        @error('phone') <p class="error">{{ $message }}</p> @enderror

        <!-- SKILLS -->
        <label>Skills</label>
        <input type="checkbox" name="skills[]" value="PHP"> PHP
        <input type="checkbox" name="skills[]" value="Node"> Node
        @error('skills') <p class="error">{{ $message }}</p> @enderror

        <br><br>
        <button type="submit">Submit</button>

    </form>
</div>