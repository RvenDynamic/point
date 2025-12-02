<!DOCTYPE html>
<html lang="en">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>polres notify</title>
    <link href="https://fonts.cdnfonts.com/css/lexend-mega" rel="stylesheet" />
    <style media="all" type="text/css">
        /* -------------------------------------
          GLOBAL RESETS
      ------------------------------------- */

        body {
            font-family: "Lexend Mega", sans-serif;
            -webkit-font-smoothing: antialiased;
            font-size: 16px;
            line-height: 1.3;
            -ms-text-size-adjust: 100%;
            -webkit-text-size-adjust: 100%;
        }

        table {
            border-collapse: separate;
            mso-table-lspace: 0pt;
            mso-table-rspace: 0pt;
            width: 100%;
        }

        table td {
            font-family: "Lexend Mega", sans-serif;
            font-size: 16px;
            vertical-align: top;
        }

        /* -------------------------------------
          BODY & CONTAINER
      ------------------------------------- */

        body {
            background-color: rgb(243 244 246);
            margin: 0;
            padding: 0;
        }

        .body {
            background-color: rgb(243 244 246);
            width: 100%;
        }

        .container {
            margin: 0 auto !important;
            max-width: 600px;
            padding: 0;
            padding-top: 24px;
            width: 600px;
        }

        .content {
            box-sizing: border-box;
            display: block;
            margin: 0 auto;
            max-width: 600px;
            padding: 0;
        }

        /* -------------------------------------
          HEADER, FOOTER, MAIN
      ------------------------------------- */

        .main {
            background: #ffffff;
            border: 1px solid #eaebed;
            border-radius: 16px;
            width: 100%;
            box-shadow: 3px 8px;
        }

        .wrapper {
            box-sizing: border-box;
            padding: 24px;
        }

        .footer {
            clear: both;
            padding-top: 24px;
            text-align: center;
            width: 100%;
        }

        .footer td,
        .footer p,
        .footer span,
        .footer a {
            color: #000000;
            font-size: 20px;
            text-align: center;
        }

        /* -------------------------------------
          TYPOGRAPHY
      ------------------------------------- */

        p {
            font-family: "Lexend Mega", sans-serif;
            font-size: 16px;
            font-weight: normal;
            margin: 0;
            margin-bottom: 16px;
        }

        a {
            color: #0867ec;
            text-decoration: underline;
        }

        label {
            color: black;
            text-decoration: none;
            font-weight: 800;
        }

        /* -------------------------------------
          BUTTONS
      ------------------------------------- */

        .btn {
            box-sizing: border-box;
            min-width: 100% !important;
            width: 100%;
        }

        .btn>tbody>tr>td {
            padding-bottom: 16px;
        }

        .btn table {
            width: auto;
            display: flex;
            justify-content: center;
        }

        .btn table td {
            background-color: rgb(243 244 246);
            border-radius: 10px;
            box-shadow: 2px 6px;
            text-align: center;
            border: solid 2px black;
            transition-duration: 200ms;
            transform: translateX(-1px);
            transform: translateY(-4px);
        }

        .btn a {
            background-color: #ffffff;
            border-radius: 4px;
            box-sizing: border-box;
            color: rgb(243 244 246);
            cursor: pointer;
            display: inline-block;
            font-size: 18px;
            font-weight: 800;
            margin: 0;
            padding: 14px 56px;
            text-decoration: none;
            text-transform: capitalize;
        }

        .btn label {
            background-color: #ffffff;
            border-radius: 4px;
            box-sizing: border-box;
            color: rgb(243 244 246);
            cursor: text;
            display: inline-block;
            font-size: 18px;
            font-weight: 800;
            margin: 0;
            padding: 14px 56px;
            text-decoration: none;
            text-transform: capitalize;
        }

        .btn-primary table td {
            background-color: rgb(243 244 246);
        }

        .btn-primary a {
            background-color: rgb(243 244 246);
            border-color: black;
            color: black;
        }

        .btn-primary label {
            background-color: rgb(243 244 246);
            border-color: black;
            color: black;
        }

        .image {
            display: flex;
            justify-content: center;
            margin-bottom: 30px;
        }

        .border-image {
            background-color: white;
            padding: 5px 20px;
            box-shadow: 3px 8px;
            border-radius: 10px;
        }

        .gif {
            justify-content: center;
        }

        .cara {
            width: 550px;
        }

        @media all {
            .btn-primary table td:focus {
                background-color: rgb(243 244 246) !important;
                outline: none !important;
            }

            .btn table td:active {
                transform: translateX(0px);
                transform: translateY(0px);
                box-shadow: none;
            }
        }

        /* -------------------------------------
          OTHER STYLES THAT MIGHT BE USEFUL
      ------------------------------------- */

        .last {
            margin-bottom: 0;
        }

        .first {
            margin-top: 0;
        }

        .align-center {
            text-align: center;
        }

        .align-right {
            text-align: right;
        }

        .align-left {
            text-align: left;
        }

        .text-link {
            color: #0867ec !important;
            text-decoration: underline !important;
        }

        .clear {
            clear: both;
        }

        .mt0 {
            margin-top: 0;
        }

        .mb0 {
            margin-bottom: 0;
        }

        .preheader {
            color: transparent;
            display: none;
            height: 0;
            max-height: 0;
            max-width: 0;
            opacity: 0;
            overflow: hidden;
            mso-hide: all;
            visibility: hidden;
            width: 0;
        }

        .powered-by a {
            text-decoration: none;
        }

        /* -------------------------------------
          RESPONSIVE AND MOBILE FRIENDLY STYLES
      ------------------------------------- */

        @media only screen and (max-width: 640px) {

            .main p,
            .main td,
            .main span {
                font-size: 16px !important;
            }

            .cara {
                width: 350px;
            }

            .wrapper {
                padding: 8px !important;
            }

            .content {
                padding: 0 !important;
            }

            .container {
                padding: 0 !important;
                padding-top: 8px !important;
                width: 100% !important;
            }

            .main {
                border-left-width: 0 !important;
                border-radius: 0 !important;
                border-right-width: 0 !important;
            }

            .btn table {
                max-width: 100% !important;
                width: 100% !important;
            }

            .btn a {
                font-size: 16px !important;
                max-width: 100% !important;
                width: 100% !important;
            }

            .btn label {
                font-size: 16px !important;
                max-width: 100% !important;
                width: 100% !important;
            }
        }

        /* -------------------------------------
          PRESERVE THESE STYLES IN THE HEAD
      ------------------------------------- */

        @media all {
            .ExternalClass {
                width: 100%;
            }

            .ExternalClass,
            .ExternalClass p,
            .ExternalClass span,
            .ExternalClass font,
            .ExternalClass td,
            .ExternalClass div {
                line-height: 100%;
            }

            .apple-link a {
                color: inherit !important;
                font-family: inherit !important;
                font-size: inherit !important;
                font-weight: inherit !important;
                line-height: inherit !important;
                text-decoration: none !important;
            }

            #MessageViewBody a {
                color: inherit;
                text-decoration: none;
                font-size: inherit;
                font-family: inherit;
                font-weight: inherit;
                line-height: inherit;
            }
        }
    </style>
</head>

<body>
    <table role="presentation" border="0" cellpadding="0" cellspacing="0" class="body">
        <tr>
            <td>&nbsp;</td>
            <td class="container">
                <div class="content">
                    <!-- START CENTERED WHITE CONTAINER -->
                    <span class="preheader">Terdeteksi terdapat aktivitas login pada akun Anda di
                        perangkat lain.</span>
                    <table role="presentation" border="0" cellpadding="0" cellspacing="0" class="main">
                        <!-- START MAIN CONTENT AREA -->
                        <tr>
                            <td class="wrapper">
                                <div class="image">
                                    <div class="border-image">
                                        <img src="https://upload.wikimedia.org/wikipedia/commons/4/46/Lambang_Polda_Jateng.png"
                                            alt="Polres Pekalongan" width="100px" />
                                    </div>
                                </div>
                                <p>
                                    Hi <?= $username ?> (<?= $email ?>)
                                </p>
                                <p>
                                    Akun Anda terdeteksi melakukan aktivitas login dari
                                    perangkat <?= $device ?>. Anda mendapatkan email ini untuk
                                    memastikan apakah itu memang Anda.
                                </p>
                                <p>
                                    Abaikan email ini jika itu memang Anda. Jika itu
                                    <b>bukan</b> Anda, maka segera ganti password akun Anda.
                                </p>
                                <!-- <p>
                                    Berikut cara untuk mengganti password (Ini adalah gif) :
                                </p>
                                <div class="gif">
                                    <img class="cara" src="/public/img/ganti_password.gif" alt="gif" />
                                </div> -->
                            </td>
                        </tr>

                        <!-- END MAIN CONTENT AREA -->
                    </table>

                    <!-- START FOOTER -->
                    <div class="footer">
                        <table role="presentation" border="0" cellpadding="0" cellspacing="0">
                            <tr>
                                <td class="content-block">
                                    <span class="apple-link">Jl. Rinjani No.1, Tanjungsari, Kec. Kajen,</span>
                                </td>
                            </tr>
                            <tr>
                                <td class="content-block">
                                    <span>Kab. Pekalongan</span>
                                </td>
                            </tr>
                        </table>
                    </div>

                    <!-- END FOOTER -->

                    <!-- END CENTERED WHITE CONTAINER -->
                </div>
            </td>
            <td>&nbsp;</td>
        </tr>
    </table>
</body>

</html>