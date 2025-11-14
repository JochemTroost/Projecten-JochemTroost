{* templates/characterList.tpl *}
{extends file='layout.tpl'}

{block name='content'}
    <div class="container my-5">
        <h2>Character List</h2>

        <a href="index.php?page=createCharacter" class="btn btn-primary mb-3">Create New Character</a>

        <table class="table table-striped table-bordered bg-light">
            <thead class="thead-dark">
            <tr>
                <th>Name</th>
                <th>Role</th>
                <th>Health</th>
                <th>Attack</th>
                <th>Defence</th>
                <th>Range</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            {foreach $characterList as $character}
                <tr>
                    <td>{$character->getName()}</td>
                    <td>{$character->getRole()}</td>
                    <td>{$character->getHealth()}</td>
                    <td>{$character->getAttack()}</td>
                    <td>{$character->getDefence()}</td>
                    <td>{$character->getRange()}</td>
                    <td>
                        <a href="index.php?page=viewCharacter&name={$character->getName()}" class="btn btn-sm btn-info">View</a>
                        <a href="index.php?page=deleteCharacter&name={$character->getName()}" class="btn btn-sm btn-danger">Delete</a>
                    </td>
                </tr>
            {/foreach}
            </tbody>
        </table>

        <p><strong>Total Characters:</strong> {count($characterList)}</p>
    </div>
{/block}
