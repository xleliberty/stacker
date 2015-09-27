<?php

require __DIR__ . '/../vendor/autoload.php';


if (!getenv('BRANCH_NAME')) {
	die('you must provide branch name env');
}

if (!getenv('DB_USERNAME')) {
	die('you must provide db username');
}


if (!getenv('DB_PASSWORD')) {
	die('you must provide db pwd');
}

if (!getenv('DB_HOST')) {
	die('you must provide db host');
}

$config = new \Doctrine\DBAL\Configuration();
$connectionParams = array(
    'dbname' => getenv('BRANCH_NAME'),
    'user' => getenv('DB_USERNAME'),
    'password' => getenv('DB_PASSWORD'),
    'host' => getenv('DB_HOST'),
    'driver' => 'pdo_pgsql',
);
$conn = \Doctrine\DBAL\DriverManager::getConnection($connectionParams, $config);
$result = $conn->fetchAll('SELECT * FROM tags LIMIT 10');

?>

<html>
    <body>
        <pre>
        I am HOST <?php print_r( $_SERVER['SERVER_ADDR']); ?>
        </pre>
		<h4>BRANCH 1:  here are tags</h4>
		<h4>We are working on DB: <?php echo getenv('BRANCH_NAME'); ?></h4>
		
		<ul>
			<?php foreach ($result as $row): ?>
				<li><?php echo $row['slug']?></li>
			<?php endforeach ?>
		</ul>
	</body>
</html>
