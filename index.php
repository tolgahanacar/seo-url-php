<?php
declare(strict_types=1);

require_once 'utility/connect.php';
require_once 'utility/functions.php';

try {
    $query = $db->query("SELECT * FROM posts");
    $posts = $query->fetchAll();
} catch (PDOException $e) {
    error_log("Database query error: " . $e->getMessage());
    $posts = [];
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="SEO Friendly URL Demonstration in PHP - Clean, responsive, and secure.">
    <title>SEO URL - PHP Modern Showcase</title>
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

        header {
            padding: 3rem 1.5rem 1.5rem;
            text-align: center;
        }

        header h1 {
            font-size: 2.5rem;
            font-weight: 700;
            background: var(--accent-grad);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            margin-bottom: 0.5rem;
            letter-spacing: -0.05em;
        }

        header p {
            color: var(--text-muted);
            font-size: 1.1rem;
            max-width: 600px;
            margin: 0 auto;
        }

        main {
            flex-grow: 1;
            max-width: 1200px;
            width: 100%;
            margin: 0 auto;
            padding: 2rem 1.5rem;
        }

        .grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(320px, 1fr));
            gap: 2rem;
        }

        .card {
            background: var(--card-bg);
            border: 1px solid var(--border-color);
            border-radius: 16px;
            padding: 1.75rem;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            transition: transform 0.3s ease, border-color 0.3s ease, box-shadow 0.3s ease;
        }

        .card:hover {
            transform: translateY(-4px);
            border-color: rgba(99, 102, 241, 0.4);
            box-shadow: 0 10px 25px -5px rgba(99, 102, 241, 0.1), 0 8px 10px -6px rgba(99, 102, 241, 0.1);
        }

        .card-body h3 {
            font-size: 1.35rem;
            font-weight: 600;
            margin-bottom: 0.75rem;
            color: var(--text-main);
            letter-spacing: -0.02em;
        }

        .card-body p {
            color: var(--text-muted);
            font-size: 0.95rem;
            margin-bottom: 1.5rem;
        }

        .card-footer {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-top: auto;
            border-top: 1px solid rgba(255, 255, 255, 0.05);
            padding-top: 1rem;
        }

        .card-date {
            font-size: 0.8rem;
            color: var(--text-muted);
        }

        .btn-more {
            display: inline-block;
            background: var(--accent-grad);
            color: #fff;
            text-decoration: none;
            padding: 0.5rem 1.25rem;
            border-radius: 8px;
            font-weight: 500;
            font-size: 0.9rem;
            transition: opacity 0.2s ease, transform 0.2s ease;
        }

        .btn-more:hover {
            opacity: 0.9;
            transform: scale(1.03);
        }

        .no-content {
            grid-column: 1 / -1;
            text-align: center;
            padding: 4rem 2rem;
            background: var(--card-bg);
            border: 1px solid var(--border-color);
            border-radius: 16px;
        }

        .no-content h2 {
            font-size: 1.5rem;
            margin-bottom: 0.5rem;
        }

        .no-content p {
            color: var(--text-muted);
        }

        footer {
            padding: 2.5rem 1.5rem;
            background: rgba(17, 24, 39, 0.4);
            border-top: 1px solid var(--border-color);
            text-align: center;
        }

        footer h2 {
            font-size: 1.1rem;
            margin-bottom: 0.75rem;
            font-weight: 600;
            letter-spacing: -0.01em;
        }

        footer .links {
            display: flex;
            justify-content: center;
            gap: 1.5rem;
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
    <header>
        <h1>SEO URL - PHP</h1>
        <p>A beautiful demonstration of generating and routing clean, search-engine-optimized URLs in modern PHP.</p>
    </header>

    <main>
        <div class="grid">
            <?php if (!empty($posts)): ?>
                <?php foreach ($posts as $post): ?>
                    <div class="card">
                        <div class="card-body">
                            <h3><?= htmlspecialchars($post->postname) ?></h3>
                            <p><?= htmlspecialchars($post->postdesc) ?></p>
                        </div>
                        <div class="card-footer">
                            <span class="card-date">
                                <?= date('M d, Y', strtotime($post->postdate)) ?>
                            </span>
                            <a class="btn-more" href="post/<?= htmlspecialchars(seolink($post->postname)) . '-' . (int)$post->id ?>">More</a>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="no-content">
                    <h2>No Posts Found</h2>
                    <p>Make sure you have imported the SQL file and database is running.</p>
                </div>
            <?php endif; ?>
        </div>
    </main>

    <footer>
        <h2>Created By</h2>
        <div class="links">
            <a href="https://github.com/tolgahanacar" target="_blank" rel="noopener noreferrer">Github</a>
            <a href="https://tolgahanacar.net" target="_blank" rel="noopener noreferrer">tolgahanacar.net</a>
        </div>
    </footer>
</body>
</html>
