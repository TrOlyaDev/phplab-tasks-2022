<?php
require_once './functions.php';

$airports = require './airports.php';
const PAGE_SIZE = 20;

parseGetRequest();
$pages = numberOfPages();
$GLOBALS['airports'] = pagination();

/**
 * Parse GET request
 *
 * @return void
 */
function parseGetRequest(): void
{
    if (isset($_GET['filter_by_first_letter'])) {
        $GLOBALS['airports'] = filterByFirstLetter();
    }
    if (isset($_GET['filter_by_state'])) {
        $GLOBALS['airports'] = filterByState();
    }
    if (isset($_GET['sort'])) {
        uasort($GLOBALS['airports'], 'sortByKey');
    }
}

//Filtering
/**
 * Filter by the first letter in airport name
 *
 * @return array
 */
function filterByFirstLetter(): array
{
    $result = [];
    array_map(function ($elem) use (&$result) {
        if ($elem['name'][0] === $_GET['filter_by_first_letter']) {
            $result[] = $elem;
        }
    }, $GLOBALS['airports']);

    return $result;
}

/**
 * Filter by state
 *
 * @return array
 */
function filterByState(): array
{
    $result = [];
    array_map(function ($elem) use (&$result) {
        if ($elem['state'] === $_GET['filter_by_state']) {
            $result[] = $elem;
        }
    }, $GLOBALS['airports']);

    return $result;
}

// Sorting
/**
 * Compare two array elements
 *
 * @param array $elem1
 * @param array $elem2
 * @return int
 */
function sortByKey(array $elem1, array $elem2): int
{
    return strcasecmp($elem1[$_GET['sort']], $elem2[$_GET['sort']]);
}

// Pagination
/**
 * Count number of pages
 *
 * @return int
 */
function numberOfPages(): int
{
    return round(count($GLOBALS['airports']) / PAGE_SIZE);
}

/**
 * Pagination
 *
 * @return array info for current page
 */
function pagination(): array
{
    $_GET['page'] = (isset($_GET['page']) && is_numeric($_GET['page']) && ($_GET['page'] > 0)) ? $_GET['page'] : 1;
    $offset = ($_GET['page'] - 1) * PAGE_SIZE;

    return array_slice($GLOBALS['airports'], $offset, PAGE_SIZE);
}
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <title>Airports</title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
</head>
<body>
<main role="main" class="container">

    <h1 class="mt-5">US Airports</h1>

    <!--
        Filtering task #1
        Replace # in HREF attribute so that link follows to the same page with the filter_by_first_letter key
        i.e. /?filter_by_first_letter=A or /?filter_by_first_letter=B

        Make sure, that the logic below also works:
         - when you apply filter_by_first_letter the page should be equal 1
         - when you apply filter_by_first_letter, than filter_by_state (see Filtering task #2) is not reset
           i.e. if you have filter_by_state set you can additionally use filter_by_first_letter
    -->
    <div class="alert alert-dark">
        Filter by first letter:

        <?php foreach (getUniqueFirstLetters(require './airports.php') as $letter): ?>
            <a href="<?= $_SERVER["PHP_SELF"]."?".http_build_query(array_merge($_GET, ["page" => 1, "filter_by_first_letter" => $letter])); ?>"><?= $letter ?></a>
        <?php endforeach; ?>

        <a href="./" class="float-right">Reset all filters</a>
    </div>

    <!--
        Sorting task
        Replace # in HREF so that link follows to the same page with the sort key with the proper sorting value
        i.e. /?sort=name or /?sort=code etc

        Make sure, that the logic below also works:
         - when you apply sorting pagination and filtering are not reset
           i.e. if you already have /?page=2&filter_by_first_letter=A after applying sorting the url should looks like
           /?page=2&filter_by_first_letter=A&sort=name
    -->
    <table class="table">
        <thead>
        <tr>
            <th scope="col"><a href="<?= $_SERVER["PHP_SELF"]."?".http_build_query(array_merge($_GET, ["sort" => "name"])); ?>">Name</a></th>
            <th scope="col"><a href="<?= $_SERVER["PHP_SELF"]."?".http_build_query(array_merge($_GET, ["sort" => "code"])); ?>">Code</a></th>
            <th scope="col"><a href="<?= $_SERVER["PHP_SELF"]."?".http_build_query(array_merge($_GET, ["sort" => "state"])); ?>">State</a></th>
            <th scope="col"><a href="<?= $_SERVER["PHP_SELF"]."?".http_build_query(array_merge($_GET, ["sort" => "city"])); ?>">City</a></th>
            <th scope="col">Address</th>
            <th scope="col">Timezone</th>
        </tr>
        </thead>
        <tbody>
        <!--
            Filtering task #2
            Replace # in HREF so that link follows to the same page with the filter_by_state key
            i.e. /?filter_by_state=A or /?filter_by_state=B

            Make sure, that the logic below also works:
             - when you apply filter_by_state the page should be equal 1
             - when you apply filter_by_state, than filter_by_first_letter (see Filtering task #1) is not reset
               i.e. if you have filter_by_first_letter set you can additionally use filter_by_state
        -->
        <?php foreach ($airports as $airport): ?>
        <tr>
            <td><?= $airport['name'] ?></td>
            <td><?= $airport['code'] ?></td>
            <td><a href="<?= $_SERVER["PHP_SELF"]."?".http_build_query(array_merge($_GET, ['filter_by_state' => $airport['state'], 'page' => 1])); ?>"><?= $airport['state'] ?></a></td>
            <td><?= $airport['city'] ?></td>
            <td><?= $airport['address'] ?></td>
            <td><?= $airport['timezone'] ?></td>
        </tr>
        <?php endforeach; ?>
        </tbody>
    </table>

    <!--
        Pagination task
        Replace HTML below so that it shows real pages dependently on number of airports after all filters applied

        Make sure, that the logic below also works:
         - show 20 airports per page
         - use page key (i.e. /?page=1)
         - when you apply pagination - all filters and sorting are not reset
    -->
    <nav aria-label="Navigation">
        <ul class="pagination justify-content-center">
            <?php for ($i = 1; $i <= $pages; $i++): ?>
                <li class="page-item <?php if ($_GET['page'] == $i): ?> active <?php endif; ?>">
                    <a class="page-link" href="<?= $_SERVER["PHP_SELF"]."?".http_build_query(array_merge($_GET, ["page" => $i])); ?>">
                        <?= $i ?>
                    </a>
                </li>
            <?php endfor; ?>
        </ul>
    </nav>

</main>
</html>
