<!-- test/testMap -->

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <title>Modale</title>

    <style type="text/css">
        /* The Modal (background) */
        .modal {

            position: fixed;
            /* Stay in place */
            z-index: 3;
            /* Sit on top */
            left: 0;
            top: 0;
            width: 100%;
            /* Full width */
            height: 100%;
            /* Full height */
            overflow: auto;
            /* Enable scroll if needed */
            background-color: rgba(0, 0, 0, 0.4);
            /* Black w/ opacity */
        }

        /* Modal Content */
        .modal-content {
            position: relative;
            background-color: #fefefe;

            margin: 15% auto;
            padding: 0;

            border: none;
            border-radius: 40px;

            max-width: 600px;
            max-height: 700px;
            width: 100%;
            height: auto;

            box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);

            -webkit-animation-name: animatetop;
            -webkit-animation-duration: 1s;
            animation-name: animatetop;
            animation-duration: 1s;
        }

        /* Add Animation */
        @-webkit-keyframes animatetop {
            from {
                top: -300px;
                opacity: 0;
            }

            to {
                top: 0;
                opacity: 1;
            }
        }

        @keyframes animatetop {
            from {
                top: -300px;
                opacity: 0;
            }

            to {
                top: 0;
                opacity: 1;
            }
        }


        @keyframes animatebottom {
            from {
                top: 0;
                opacity: 1;
            }

            to {
                top: -300px;
                opacity: 0;
            }
        }

        @-webkit-keyframes animatebottom {
            from {
                top: 0;
                opacity: 1;
            }

            to {
                top: -300px;
                opacity: 0;
            }
        }


        /* The Close Button */
        .close-button {

            height: 50px;
            width: 300px;

            margin: 0px 63px;


            color: white;
            background: #1EC81B;

            font-size: 24px;
            font-weight: bold;

            border-radius: 40px;
            border: none;

            transition: all ease-in-out 1s;

            text-decoration: none;
            display: inline-block;
            cursor: pointer;

        }

        .close-button:hover,
        .close-button:focus {

            /* height: 60px;
  width: 310px; */

            background-color: white;
            color: #1EC81B;

            border: solid #1EC81B 1px;
        }

        .modal-header {
            padding: 2px 16px;
            background-color: #1EC81B;
            color: white;
        }

        .modal-body {
            display: flex;
            flex-direction: column;

            padding: 39px;
            align-items: center;
        }
    </style>

</head>

<body>

    <!-- The Modal -->
    <div id="modal" class="modal">

        <!-- Modal content -->
        <div class="modal-content">

            <div class="modal-body" id="modal-body">

                <p>Some text in the Modal Body</p>
                <p>Some other text...</p>

                <form id="modifForm" accept-charset="utf-8">

                    <input type="text" id="newLastName" placeholder="Nouveau nom de famille" required/>

                    <button type="submit">Valider</button>

                </form>

                <a href="<?= base_url('User/home/info'); ?>">Annuler</a></br>

            </div>
        </div>
    </div>


    <h1>BlaBla</h1>

    <script type="text/javascript">
    
    const modalBody = document.getElementById('modal-body');
    const form = document.getElementById("modifForm");

    form.addEventListener("submit", function (event) {

        event.preventDefault();

        var newLastName = document.getElementById("newLastName").value;

        modalBody.innerHTML = "";

    });

    </script>

</body>

</html>

<!-- test/testMap -->