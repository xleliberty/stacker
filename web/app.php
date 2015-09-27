<?php

require __DIR__ . '/../vendor/autoload.php';

phpinfo();

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
        <?php print_r( $_SERVER); ?>
        </pre>
		<h4>BRANCH 2 here are tags</h4>
		<ul>
			<?php foreach ($result as $row): ?>
				<li><?php echo $row['slug']?></li>
			<?php endforeach ?>
		</ul>
	</body>
</html>
