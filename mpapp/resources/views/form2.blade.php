<!DOCTYPE html>
<html>

<head>
    <title>Form2 Validation</title>
    <link rel="stylesheet" href="{{ asset('css/form1.css') }}">
</head>

<body>

    <h2>Add New User</h2>

    <!-- SUCCESS MESSAGE -->
    @if(session('success'))
    <p style="color:green;">{{ session('success') }}</p>
    @endif

    <!-- ALL ERRORS -->
    @if($errors->any())
    <div style="color:red;">
        <ul>
            @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form action="/form2" method="POST">
        @csrf

        <!-- NAME -->
        <label>Name:</label>
        <input type="text" name="name" value="{{ old('name') }}">
        @error('name') <p style="color:red;">{{ $message }}</p> @enderror
        <br><br>

        <!-- EMAIL -->
        <label>Email:</label>
        <input type="email" name="email" value="{{ old('email') }}">
        @error('email') <p style="color:red;">{{ $message }}</p> @enderror
        <br><br>

        <!-- PASSWORD -->
        <label>Password:</label>
        <input type="password" name="password">
        @error('password') <p style="color:red;">{{ $message }}</p> @enderror
        <br><br>

        <!-- DOB -->
        <label>Date of Birth:</label>
        <input type="date" name="dob" value="{{ old('dob') }}">
        @error('dob') <p style="color:red;">{{ $message }}</p> @enderror
        <br><br>

        <!-- GENDER -->
        <label>Gender:</label>
        <input type="radio" name="gender" value="male" {{ old('gender')=='male' ? 'checked' : '' }}> Male
        <input type="radio" name="gender" value="female" {{ old('gender')=='female' ? 'checked' : '' }}> Female
        @error('gender') <p style="color:red;">{{ $message }}</p> @enderror
        <br><br>

        <!-- SKILLS -->
        <label>Skills:</label><br>

        <input type="checkbox" name="skills[]" value="HTML"
            {{ is_array(old('skills')) && in_array('HTML', old('skills')) ? 'checked' : '' }}> HTML

        <input type="checkbox" name="skills[]" value="CSS"
            {{ is_array(old('skills')) && in_array('CSS', old('skills')) ? 'checked' : '' }}> CSS

        <input type="checkbox" name="skills[]" value="JS"
            {{ is_array(old('skills')) && in_array('JS', old('skills')) ? 'checked' : '' }}> JS

        @error('skills') <p style="color:red;">{{ $message }}</p> @enderror
        <br><br>

        <!-- COUNTRY -->
        <label>Country:</label>
        <select name="country">
            <option value="">Select</option>
            <option value="india" {{ old('country')=='india' ? 'selected' : '' }}>India</option>
            <option value="usa" {{ old('country')=='usa' ? 'selected' : '' }}>USA</option>
        </select>
        @error('country') <p style="color:red;">{{ $message }}</p> @enderror
        <br><br>

        <button type="submit">Submit</button>

    </form>

</body>

</html>