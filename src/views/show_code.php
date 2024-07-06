<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mostrar Código Aleatório</title>
    <!-- Incluindo o Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: "Roboto";
            margin: 0;
            padding: 0;
        }

        @keyframes confetti-slow {
        0% {
            transform: translate3d(0, 0, 0) rotateX(0) rotateY(0);
        }
        100% {
            transform: translate3d(50px, 105vh, 0) rotateX(360deg) rotateY(180deg);
        }
        }
        @keyframes confetti-medium {
        0% {
            transform: translate3d(0, 0, 0) rotateX(0) rotateY(0);
        }
        100% {
            transform: translate3d(100px, 105vh, 0) rotateX(100deg) rotateY(360deg);
        }
        }
        @keyframes confetti-fast {
        0% {
            transform: translate3d(0, 0, 0) rotateX(0) rotateY(0);
        }
        100% {
            transform: translate3d(-50px, 105vh, 0) rotateX(10deg) rotateY(250deg);
        }
        }
        .container {
            width: 100vw;
            height: 100vh;
            background: #ffffff;
            border: 1px solid white;
            display: fixed;
            top: 0px;
        }

        .confetti-container {
            perspective: 700px;
            position: absolute;
            overflow: hidden;
            top: 0;
            right: 0;
            bottom: 0;
            left: 0;
        }

        .confetti {
            position: absolute;
            z-index: 1;
            top: -10px;
            border-radius: 0%;
        }
        .confetti--animation-slow {
            animation: confetti-slow 2.25s linear 1 forwards;
        }
        .confetti--animation-medium {
            animation: confetti-medium 1.75s linear 1 forwards;
        }
        .confetti--animation-fast {
            animation: confetti-fast 1.25s linear 1 forwards;
        }

        .checkmark-circle {
            width: 150px;
            height: 150px;
            position: relative;
            display: inline-block;
            vertical-align: top;
            margin-left: auto;
            margin-right: auto;
        }

        .checkmark-circle .background {
            width: 150px;
            height: 150px;
            border-radius: 50%;
            background: #00c09d;
            position: absolute;
        }

        .checkmark-circle .checkmark {
            border-radius: 5px;
        }

        .checkmark-circle .checkmark.draw:after {
            -webkit-animation-delay: 100ms;
            -moz-animation-delay: 100ms;
            animation-delay: 100ms;
            -webkit-animation-duration: 3s;
            -moz-animation-duration: 3s;
            animation-duration: 3s;
            -webkit-animation-timing-function: ease;
            -moz-animation-timing-function: ease;
            animation-timing-function: ease;
            -webkit-animation-name: checkmark;
            -moz-animation-name: checkmark;
            animation-name: checkmark;
            -webkit-transform: scaleX(-1) rotate(135deg);
            -moz-transform: scaleX(-1) rotate(135deg);
            -ms-transform: scaleX(-1) rotate(135deg);
            -o-transform: scaleX(-1) rotate(135deg);
            transform: scaleX(-1) rotate(135deg);
            -webkit-animation-fill-mode: forwards;
            -moz-animation-fill-mode: forwards;
            animation-fill-mode: forwards;
        }

        .checkmark-circle .checkmark:after {
            opacity: 1;
            height: 100px;
            width: 37.5px;
            -webkit-transform-origin: left top;
            -moz-transform-origin: left top;
            -ms-transform-origin: left top;
            -o-transform-origin: left top;
            transform-origin: left top;
            border-right: 15px solid white;
            border-top: 15px solid white;
            border-radius: 2.5px !important;
            content: "";
            left: 25px;
            top: 75px;
            position: absolute;
        }

        @-webkit-keyframes checkmark {
        0% {
            height: 0;
            width: 0;
            opacity: 1;
        }
        20% {
            height: 0;
            width: 37.5px;
            opacity: 1;
        }
        40% {
            height: 75px;
            width: 37.5px;
            opacity: 1;
        }
        100% {
            height: 75px;
            width: 75px;
            opacity: 1;
        }
        }
        @-moz-keyframes checkmark {
        0% {
            height: 0;
            width: 0;
            opacity: 1;
        }
        20% {
            height: 0;
            width: 37.5px;
            opacity: 1;
        }
        40% {
            height: 75px;
            width: 37.5px;
            opacity: 1;
        }
        100% {
            height: 75px;
            width: 37.5px;
            opacity: 1;
        }
        }
        @keyframes checkmark {
        0% {
            height: 0;
            width: 0;
            opacity: 1;
        }
        20% {
            height: 0;
            width: 37.5px;
            opacity: 1;
        }
        40% {
            height: 75px;
            width: 37.5px;
            opacity: 1;
        }
        100% {
            height: 75px;
            width: 37.5px;
            opacity: 1;
        }
        }
        .submit-btn {
            height: 45px;
            width: 200px;
            font-size: 15px;
            background-color: #00c09d;
            border: 1px solid #00ab8c;
            color: #fff;
            border-radius: 5px;
            box-shadow: 0 2px 4px 0 rgba(87, 71, 81, 0.2);
            cursor: pointer;
            transition: all 2s ease-out;
            transition: all 0.2s ease-out;
        }

        .submit-btn:hover {
            background-color: #2ca893;
            transition: all 0.2s ease-out;
        }
        @media (max-width: 767px) {
            .container {
                width: 100%;
                padding: 0 15px;
            }

            .card {
                margin: 0;
                box-shadow: none;
            }
        
            .input-group .form-control, .input-group .input-group-append .btn {
                font-size: 14px;
            }
        
            .input-group {
                flex-direction: column;
                align-items: stretch;
            }
        
            .input-group .form-control {
                margin-bottom: 10px;
            }
        
            .input-group-append {
                width: 100%;
            }
            
            .input-group .form-control {
                margin-bottom: 10px;
                width: 100%;
            }
        
            .input-group-append .btn {
                width: 100%;
            }
        
            .btn-success {
                width: 100%;
                font-size: 14px;
            }
        
            .checkmark-circle {
                width: 100px;
                height: 100px;
            }
        
            .checkmark-circle .background {
                width: 100px;
                height: 100px;
            }
        
            .checkmark-circle .checkmark:after {
                height: 75px;
                width: 25px;
                border-right: 10px solid white;
                border-top: 10px solid white;
                left: 20px;
                top: 50px;
            }
        
            .submit-btn {
                width: 100%;
                font-size: 14px;
            }
}
    </style>
</head>
<body>
    <div class="js-container container" style="top:0px !important;">
        <div class="container mt-5">
            <div class="card">
                <div class="card-body">
                    <img width="100" src="https://grupoconstrufacil.com.br/campanha_rima/static/img/logo.png" alt="Logo Promoção">
                    <h2 class="card-title">Parabens <?php echo $args['first_name']; ?></h2>
                    <h4 class="card-title">Agora corra 🏃🏽‍♂️ e use esse codigo na loja e tenha condições exclusivas 🤩</h4>
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" id="codigoAleatorio" value="<?php echo $args['discount_code']; ?>" readonly>
                        <div class="input-group-append">
                            <button class="btn btn-outline-secondary" type="button" id="copiarBtn">Copiar</button>
                        </div>
                    </div>
                    <a href="https://api.whatsapp.com/send?phone=553832516430&text=Meu codigo de desconto é <?php echo urlencode($args['discount_code']); ?>" class="btn btn-success" target="_blank">Contatar via WhatsApp</a>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('copiarBtn').addEventListener('click', function() {
            var codigoAleatorio = document.getElementById('codigoAleatorio');
            codigoAleatorio.select();
            codigoAleatorio.setSelectionRange(0, 99999); // Para dispositivos móveis
            document.execCommand('copy');
            alert('Código copiado: ' + codigoAleatorio.value);
        });
    </script>
    <script>
        const Confettiful = function(el) {
            this.el = el;
            this.containerEl = null;
            this.confettiFrequency = 10;
            this.confettiColors = ['#EF2964', '#00C09D', '#2D87B0', '#48485E','#EFFF1D'];
            this.confettiAnimations = ['slow', 'medium', 'fast'];
            this._setupElements();
            this._renderConfetti();
        };

        Confettiful.prototype._setupElements = function() {
            const containerEl = document.createElement('div');
            const elPosition = this.el.style.position;
            if (elPosition !== 'relative' || elPosition !== 'absolute') {
                this.el.style.position = 'relative';
            }
            containerEl.classList.add('confetti-container');
            this.el.appendChild(containerEl);
            this.containerEl = containerEl;
        };

        Confettiful.prototype._renderConfetti = function() {
            this.confettiInterval = setInterval(() => {
                const confettiEl = document.createElement('div');
                const confettiSize = (Math.floor(Math.random() * 3) + 7) + 'px';
                const confettiBackground = this.confettiColors[Math.floor(Math.random() * this.confettiColors.length)];
                const confettiLeft = (Math.floor(Math.random() * this.el.offsetWidth)) + 'px';
                const confettiAnimation = this.confettiAnimations[Math.floor(Math.random() * this.confettiAnimations.length)];
                
                confettiEl.classList.add('confetti', 'confetti--animation-' + confettiAnimation);
                confettiEl.style.left = confettiLeft;
                confettiEl.style.width = confettiSize;
                confettiEl.style.height = confettiSize;
                confettiEl.style.backgroundColor = confettiBackground;
                
                confettiEl.removeTimeout = setTimeout(function() {
                    confettiEl.parentNode.removeChild(confettiEl);
                }, 3000);
                
                this.containerEl.appendChild(confettiEl);
            }, 25);
        };

        window.confettiful = new Confettiful(document.querySelector('.js-container'));
    </script>
</body>
</html>
