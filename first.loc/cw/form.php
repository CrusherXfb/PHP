<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

</head>

<body>
    <div class="container">
        <form action="form_handler.php" method="POST">
            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input class="form-control" id="name" name="name">
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email">
            </div>

            <!-- checkbox -->
            <div class="mb-3 form-check">
                <input type="checkbox" class="form-check-input" id="camp" name="is_need_camp" value="1">
                <label class="form-check-label" for="camp">I need camp</label>
            </div>

            <!-- radios -->
            <div class="form-check">
                <input class="form-check-input" type="radio" name="abiturient_type" id="schooler" value="schooler"
                    checked="true">
                <label class="form-check-label" for="schooler">
                    I'm schooler
                </label>
            </div>

            <div class="form-check">
                <input class="form-check-input" type="radio" name="abiturient_type" id="student" value="student">
                <label class="form-check-label" for="student">
                    I'm a student of another university
                </label>
            </div>

            <div class="form-check">
                <input class="form-check-input" type="radio" name="abiturient_type" id="worker" value="worker">
                <label class="form-check-label" for="worker">
                    I have full-time job
                </label>
            </div>

            <!-- select -->
            <div class="form-floating">
                <select class="form-select" id="course" name="course" aria-label="Floating label select example">
                    <option value="FrontEnd">FrontEnd</option>
                    <option value="BackEnd">BackEnd</option>
                    <option value="Fullstack">Full-Stack</option>
                </select>
                <label for="course">Choose course</label>
            </div>

            <!-- arrays -->
            <!-- <div class="mb-3">
                <label for="p1" class="form-label">Main phone</label>
                <input class="form-control" id="p1" name="contacts[]">
            </div>
            <div class="mb-3">
                <label for="p2" class="form-label">Second phone</label>
                <input class="form-control" id="p2" name="contacts[]">
            </div> -->

            <div class="mb-3">
                <label for="p1" class="form-label">Main phone</label>
                <input class="form-control" id="p1" name="contacts[main]">
            </div>
            <div class="mb-3">
                <label for="p2" class="form-label">Second phone</label>
                <input class="form-control" id="p2" name="contacts[second]">
            </div>


            <button type="submit" class="btn btn-primary" name="sbmt" value="sbmt">Submit</button>
        </form>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
            crossorigin="anonymous"></script>
    </div>
</body>

</html>