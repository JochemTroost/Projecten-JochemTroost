<!-- Tabel header aanpassen -->
<thead class="table-dark">
<tr>
    <th>ID</th>
    <th>Name</th>
    <th>Type</th>
    <th>Value</th>
    <th>Actions</th> <!-- Nieuwe kolom -->
</tr>
</thead>

<!-- Tabel body aanpassen -->
<tbody>
{foreach from=$items item=item}
    <tr>
        <td>{$item->getId()}</td>
        <td>{$item->getName()}</td>
        <td>{$item->getType()}</td>
        <td>{$item->getValue()} gold</td>
        <td>
            <a href="index.php?page=updateItem&id={$item->getId()}" class="btn btn-sm btn-warning">Edit</a>
        </td>
    </tr>
{/foreach}
</tbody>
