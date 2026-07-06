<?php
declare(strict_types=1);

require_once 'utility/connect.php';

$id = $_REQUEST['id'] ?? null;

// Determine redirection target based on current request URI structure
$redirectHome = (strpos($_SERVER['REQUEST_URI'] ?? '', '/post/') !== false) ? '../index.php' : 'index.php';

if ($id === null || !is_numeric($id)) {
    header("Location: " . $redirectHome);
    exit;
}

try {
    $query = $db->prepare("SELECT * FROM posts WHERE id = :id");
    $query->bindValue(":id", (int)$id, PDO::PARAM_INT);
    $query->execute();
    $post = $query->fetch();
} catch (PDOException $e) {
    error_log("Database post retrieval error: " . $e->getMessage());
    $post = null;
}

if (!$post) {
    header("Location: " . $redirectHome);
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="date" content="<?= htmlspecialchars($post->postdate) ?>">
    <meta name="description" content="<?= htmlspecialchars($post->postdesc) ?> | SEO Url - PHP">
    <title><?= htmlspecialchars($post->postname) ?> - SEO Detail</title>
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --bg-color: #0b0f19;
            --card-bg: rgba(17, 24, 39, 0.7);
            --border-color: rgba(255, 255, 255, 0.08);
            --text-main: #f3f4f6;
            --text-muted: #9ca3af;
            --accent-grad: linear-gradient(135deg, #6366f1, #a855f7);
            --font-family: 'Inter', -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif;
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: var(--font-family);
            background-color: var(--bg-color);
            background-image: radial-gradient(circle at 50% 0%, rgba(99, 102, 241, 0.15) 0%, transparent 50%);
            color: var(--text-main);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            line-height: 1.6;
        }

        main {
            flex-grow: 1;
            max-width: 800px;
            width: 100%;
            margin: 0 auto;
            padding: 4rem 1.5rem;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .post-container {
            background: var(--card-bg);
            border: 1px solid var(--border-color);
            border-radius: 20px;
            padding: 3rem 2.5rem;
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            box-shadow: 0 20px 40px -15px rgba(0, 0, 0, 0.5);
        }

        .meta {
            display: flex;
            align-items: center;
            gap: 1rem;
            margin-bottom: 1.5rem;
            font-size: 0.85rem;
            color: var(--text-muted);
        }

        .badge {
            background: var(--accent-grad);
            color: #fff;
            padding: 0.25rem 0.75rem;
            border-radius: 20px;
            font-weight: 600;
            font-size: 0.75rem;
            text-transform: uppercase;
            letter-spacing: 0.05em;
        }

        h1 {
            font-size: 2.25rem;
            font-weight: 700;
            color: var(--text-main);
            margin-bottom: 1.5rem;
            line-height: 1.25;
            letter-spacing: -0.04em;
        }

        p {
            font-size: 1.1rem;
            color: #d1d5db;
            margin-bottom: 2.5rem;
            white-space: pre-line;
        }

        .btn-back {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid var(--border-color);
            color: var(--text-main);
            text-decoration: none;
            padding: 0.75rem 1.5rem;
            border-radius: 10px;
            font-weight: 500;
            font-size: 0.95rem;
            transition: background 0.2s ease, border-color 0.2s ease, transform 0.2s ease;
        }

        .btn-back:hover {
            background: rgba(255, 255, 255, 0.1);
            border-color: rgba(99, 102, 241, 0.4);
            transform: translateX(-4px);
        }

        footer {
            padding: 2rem 1.5rem;
            text-align: center;
            border-top: 1px solid var(--border-color);
            background: rgba(17, 24, 39, 0.4);
        }

        footer a {
            color: var(--text-muted);
            text-decoration: none;
            font-size: 0.9rem;
            transition: color 0.2s ease;
        }

        footer a:hover {
            color: #6366f1;
        }
    </style>
</head>
<body>
    <main>
        <div class="post-container">
            <div class="meta">
                <span class="badge">Post #<?= (int)$post->id ?></span>
                <span>•</span>
                <span>Published on <?= date('F d, Y', strtotime($post->postdate)) ?></span>
            </div>
            <h1><?= htmlspecialchars($post->postname) ?></h1>
            <p><?= htmlspecialchars($post->postdesc) ?></p>
            <a class="btn-back" href="<?= htmlspecialchars($redirectHome) ?>">
                ← Back to Home
            </a>
        </div>
    </main>

    <footer>
        <a href="<?= htmlspecialchars($redirectHome) ?>">SEO URL Showcase</a>
    </footer>
</body>
</html>
