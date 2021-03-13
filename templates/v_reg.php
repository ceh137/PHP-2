<form class="my-5">
    <p class="text-center"><?= $note ?></p>
    <div class="mb-3">
        <label for="exampleInputEmail1" class="form-label">Email address</label>
        <input type="email" class="form-control" name="emailreg" id="exampleInputEmail1" aria-describedby="emailHelp">
        <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
    </div>
    <label for="inputPassword5" class="form-label">Password</label>
    <input type="password" id="inputPassword5" name="passreg" class="form-control" aria-describedby="passwordHelpBlock">
    <div id="passwordHelpBlock" class="form-text">
        Your password must be 8-20 characters long, contain letters and numbers, and must not contain spaces, special characters, or emoji.
    </div>

    <button type="submit" class="btn btn-primary">Submit</button>
</form>