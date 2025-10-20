<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $length = isset($_POST['length']) ? intval($_POST['length']) : 16;
    $chars = '';
    
    if (isset($_POST['uppercase'])) $chars .= 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
    if (isset($_POST['lowercase'])) $chars .= 'abcdefghijklmnopqrstuvwxyz';
    if (isset($_POST['numbers'])) $chars .= '0123456789';
    if (isset($_POST['symbols'])) $chars .= '!@#$%^&*()_+-=[]{}|;:,.<>?';
    
    $senha = '';
    if ($chars) {
        for ($i = 0; $i < $length; $i++) {
            $senha .= $chars[random_int(0, strlen($chars) - 1)];
        }
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gerador de Senhas Fortes</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8 col-md-10">
                <div class="card">
                    <div class="card-header text-center">
                        <div class="d-flex align-items-center justify-content-center gap-3">
                            <div class="icon-box">
                                <i class="fas fa-lock"></i>
                            </div>
                            <div>
                                <h2 class="mb-0">Gerador de Senhas Fortes</h2>
                                <p class="mb-0 mt-1 opacity-75">Crie senhas seguras e personalizadas</p>
                            </div>
                        </div>
                    </div>
                    <div class="card-body p-4">
                        <form method="POST" action="" id="passwordForm">
                            <div class="mb-4">
                                <label class="form-label fw-bold">
                                    <i class="fas fa-key text-primary"></i> Senha Gerada
                                </label>
                                <div class="password-display position-relative">
                                    <span id="generatedPassword">
                                        <?php echo isset($senha) ? htmlspecialchars($senha) : 'Clique em "Gerar Senha" para começar'; ?>
                                    </span>
                                    <button type="button" class="btn btn-dark btn-sm ms-2" onclick="copyPassword()" title="Copiar senha">
                                        <i class="fas fa-copy text-white"></i>
                                    </button>
                                    <span id="copyTooltip" class="position-absolute top-0 start-50 translate-middle-x bg-success text-white px-2 py-1 rounded" style="display: none; font-size: 0.8rem;">
                                        Copiado!
                                    </span>
                                </div>
                            </div>

                            <div class="mb-4">
                                <label for="length" class="form-label fw-bold">
                                    <i class="fas fa-ruler-horizontal text-info"></i> Comprimento da Senha: <span id="lengthValue">16</span>
                                </label>
                                <input type="range" class="form-range" id="length" name="length" min="8" max="64" value="<?= $length ?>">
                                <div class="d-flex justify-content-between">
                                    <small class="text-muted">8</small>
                                    <small class="text-muted">64</small>
                                </div>
                            </div>
                            <div class="mb-4">
                                <label class="form-label fw-bold mb-3">
                                    <i class="fas fa-sliders-h text-warning"></i> Incluir Caracteres
                                </label>
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" type="checkbox" id="uppercase" name="uppercase" checked>
                                            <label class="form-check-label" for="uppercase">
                                                Letras Maiúsculas (A-Z)
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" type="checkbox" id="lowercase" name="lowercase" checked>
                                            <label class="form-check-label" for="lowercase">
                                                Letras Minúsculas (a-z)
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" type="checkbox" id="numbers" name="numbers" checked>
                                            <label class="form-check-label" for="numbers">
                                                Números (0-9)
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" type="checkbox" id="symbols" name="symbols" checked>
                                            <label class="form-check-label" for="symbols">
                                                Símbolos (!@#$%^&*)
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="d-grid">
                                <button type="submit" class="btn btn-primary btn-lg btn-generate">
                                    <i class="fas fa-sync-alt me-2"></i> Gerar Senha Forte
                                </button>
                            </div>
                        </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<script>
    function copyPassword() {
        const senhaSpan = document.getElementById('generatedPassword');
        const tooltip = document.getElementById('copyTooltip');

        if (!senhaSpan || !senhaSpan.textContent) return;

        navigator.clipboard.writeText(senhaSpan.textContent);

        tooltip.style.display = 'inline-block';

        setTimeout(() => {
            tooltip.style.display = 'none';
        }, 1000);
    }

    const slider = document.getElementById('length');
    const display = document.getElementById('lengthValue');

    slider.addEventListener('input', () => {
        display.textContent = slider.value;
    });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>