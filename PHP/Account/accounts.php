<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="login icon" href="../Image/ismt logo.jpg" type="logo">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Account department</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">
    <style>
        body {
            font-family: "Poppins", sans-serif;
        }
    </style>
</head>

<body>
    <div style="background: linear-gradient(to right,#3962AE, #413692 );">
        <div class="container">
            <div class="row">
                <div class="col-lg-1">
                    <a href="../dashboard.php"><img src="../../Image/ismt-sunderland-whitea.png" alt="..." class="img-fluid"></a>
            </div>
                <div class="col-lg-11">
                    <div class="heading p-3">
                        <h1 class="text-uppercase text-white text-center mb-0" style="letter-spacing: 5px;">Accounts
                            department
                        </h1>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row mt-5">
            <h3 class="mb-0 mt-5 text-secondary">Supporting Your Journey, Every Step of the Way</h3>
            <div class="card text-center mt-4">
                <div class="card-header">
                    <ul class="nav nav-tabs card-header-tabs" id="myTab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="active-tab" data-bs-toggle="tab"
                                data-bs-target="#active-content" type="button" role="tab" aria-controls="active-content"
                                aria-selected="true">Fee history</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="link-tab" data-bs-toggle="tab" data-bs-target="#link-content"
                                type="button" role="tab" aria-controls="link-content" aria-selected="false">upcoming
                                dues</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="disabled-tab" data-bs-toggle="tab"
                                data-bs-target="#disabled-content" type="button" role="tab"
                                aria-controls="disabled-content" aria-selected="false">Notice</button>
                        </li>
                    </ul>
                </div>
                <div class="card-body">
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="active-content" role="tabpanel"
                            aria-labelledby="active-tab">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Title</th>
                                        <th scope="col">Amount</th>
                                        <th scope="col">Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <th scope="row">1</th>
                                        <td>1 <sup>st</sup> semester fee </td>
                                        <td>RS 50,000/-</td>
                                        <td>2024/6/01</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">2</th>
                                        <td>2 <sup>nd</sup> semester fee </td>
                                        <td>RS 50,000/-</td>
                                        <td>2025/01/01</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">3</th>
                                        <td>3 <sup>rd</sup> semester fee </td>
                                        <td>RS 1,00,000/-</td>
                                        <td>2025/6/01</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">4</th>
                                        <td>4 <sup>th</sup> semester fee </td>
                                        <td>RS 1,00,000/-</td>
                                        <td>2026/01/01</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="tab-pane fade" id="link-content" role="tabpanel" aria-labelledby="link-tab">
                            <div class="tab-content" id="myTabContent">
                                <div class="tab-pane fade show active" id="active-content" role="tabpanel"
                                    aria-labelledby="active-tab">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th scope="col">#</th>
                                                <th scope="col">Title</th>
                                                <th scope="col">Amount</th>
                                                <th scope="col">Due Date</th>
                                                <th scope="col">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <th scope="row">1</th>
                                                <td>5 <sup>th</sup> semester fee </td>
                                                <td>RS 50,000/-</td>
                                                <td>2024/6/01</td>
                                                <td><button type="button" class="btn btn-warning">Pay now</button></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="disabled-content" role="tabpanel" aria-labelledby="disabled-tab">
                            <p class="card-text">No notice published.</p>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4"
        crossorigin="anonymous"></script>
</body>

</html>