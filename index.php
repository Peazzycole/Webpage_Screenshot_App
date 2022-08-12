<?php


function capturePage($url)
{
    // My API key
    $key = "YOUR_API_KEY";
    $request = "https://www.googleapis.com/pagespeedonline/v5/runPagespeed?url={$url}&key=" . $key;
    $getContent = file_get_contents($request);

    // decode from json format
    $json = json_decode($getContent);

    return $json;
}


if (isset($_POST['submit']) && !empty($_POST['url'])) {
    $url = $_POST['url'];
    $response = capturePage($url);
    $image = $response->lighthouseResult->audits->{'full-page-screenshot'}->details->screenshot->data;
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Tailwind Css -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css" integrity="sha512-wnea99uKIC3TJF7v4eKk4Y+lMz2Mklv18+r4na2Gn1abDRPPOeef95xTzdwGD9e6zXJBteMIhZ1+68QC5byJZw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- Bootstrap Css -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">

    <title>Document</title>

</head>

<body>
    <div class="container mx-auto ">
        <div class="lg:w-5/12 bg-white mx-auto rounded-lg shadow-lg" style="padding: 2rem">
            <h1 class="font-bold mb-3" style="font-size: 1.7rem">
                Capture Screenshot from URL
            </h1>
            <?php if (empty($_POST['url'])) : ?>
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>Error: </strong> URL field cannot be empty
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php endif; ?>
            <form action="" method="POST">
                <div class="relative">
                    <label for="footer-field" class="leading-7 text-sm text-gray-600">
                        Enter Website URL
                    </label>
                    <div class="flex justify-between items-center w-full">
                        <input type="text" id="footer-field" name="url" class="
                      w-full
                      bg-gray-100 bg-opacity-50
                      rounded
                      border border-gray-300
                      focus:bg-transparent
                      focus:ring-2
                      focus:ring-blue-200
                      focus:border-blue-500
                      text-base
                      outline-none
                      text-gray-700
                      py-1
                      px-3
                      leading-8
                      transition-colors
                      duration-200
                      ease-in-out
                      mr-3
                    " />
                        <button type="submit" name="submit" class="
                      flex-shrink-0
                      inline-flex
                      text-white
                      bg-blue-500
                      border-0
                      py-2
                      px-6
                      focus:outline-none
                      hover:bg-blue-600
                      rounded
                      transition
                      duration-300
                    ">
                            Capture
                        </button>
                    </div>
                </div>
            </form>
            <?php if (isset($image)) : ?>
                <div class="max-h-96 h-auto w-full overflow-auto mt-5 border">
                    <img src="<?= $image ?>" alt="" />
                </div>
                <a href="<?= $image ?>" download="screenshot" class="
                flex-shrink-0
                inline-flex
                text-white
                hover:bg-blue-500
                border-2 border-blue-500
                text-blue-500
                hover:text-white
                py-2
                px-6
                focus:outline-none
                hover:bg-blue-600
                rounded
                mt-3
                transition
                duration-300
              ">
                    Download
                </a>
            <?php endif; ?>

        </div>
    </div>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>


</html>
