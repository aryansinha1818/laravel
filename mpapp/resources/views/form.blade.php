<div class="form-container">

    <h2>Add New User</h2>

    <form action="/form" method="POST">
        @csrf

        <fieldset>
            <legend>Personal Information</legend>

            <div class="form-group">
                <label for="name">Full Name</label>
                <input type="text" name="name" id="name">
            </div>

            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" name="email" id="email">
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" name="password" id="password">
            </div>

            <div class="form-group">
                <label for="dob">Date of Birth</label>
                <input type="date" name="dob" id="dob">
            </div>

        </fieldset>

        <fieldset>
            <legend>Preferences</legend>

            <!-- Gender -->
            <div class="form-group">
                <label>Gender</label>
                <div class="inline-group">
                    <input type="radio" name="gender" value="male" id="male">
                    <label for="male">Male</label>

                    <input type="radio" name="gender" value="female" id="female">
                    <label for="female">Female</label>
                </div>
            </div>

            <!-- Skills -->
            <div class="form-group">
                <label>Skills</label>
                <div class="inline-group">
                    <input type="checkbox" name="skills[]" value="HTML" id="html">
                    <label for="html">HTML</label>

                    <input type="checkbox" name="skills[]" value="CSS" id="css">
                    <label for="css">CSS</label>

                    <input type="checkbox" name="skills[]" value="JavaScript" id="js">
                    <label for="js">JavaScript</label>
                </div>
            </div>

            <!-- Country -->
            <div class="form-group">
                <label for="country">Country</label>
                <select name="country" id="country">
                    <option value="">Select</option>
                    <option value="india">India</option>
                    <option value="usa">USA</option>
                </select>
            </div>

        </fieldset>

        <button type="submit">Submit</button>

    </form>

</div>