<!-- Admin/order -->

<div class="admin_content">
    <div class="menu">
            <ul>
                <li><a href="<?php echo site_url('Admin/Product')  ?>">Gerer les Produit</a></li>
                <li><a href="<?php echo site_url('Admin/User') ?>">Gerer les utilisateurs</a></li>
                <li><a href="<?php echo site_url('Admin/Order') ?>">Gerer les commandes</a></li>
                <li><a href="<?php echo site_url('Admin/Stock') ?>">Gerer le stock</a></li>
                <li><a href="<?php echo site_url('Dao') ?>">Import / Export les données</a></li>
            </ul>
        </div>

    <br>

    <?php if (isset($resultat)) { ?>
    
        <p style='color:red'><?= $resultat ?></p>

    <?php } ?>


    <?php echo form_open('Admin/order') ?>
        <p>Filtre par n° de commande :</p>
        <input type='text' name='filtre' placeholder="N° de commande"/>
        <input type="submit" value='Rechercher'>
        <a href="<?php echo site_url('Admin/Order') ?>">Annuler filtre</a>
    </form>
        

    <br>

    <?php if (isset($orders)) { foreach ($orders as $order) { echo form_open('Admin/changeStatusOrder'); ?>


        <table>
            <tr>
                <th>Numéro de commande</th>
                <th>Client</th>
                <th>Date de commande</th>
                <th>Status de la commande</th>
            </tr>
            <tr>
                <td><?= $order->getId() ?></td>
                <td><?= $user[$order->getId()]->getNom(). " " .$user[$order->getId()]->getPrenom() ?></td>
                <td><?= $order->getDate() ?></td>
                <td><?= $order->getState() ?></td>
                <td>Nouveau status : <?php echo form_dropdown($order->getId(),$options,$order->getState()); ?></td>
                <td><input type="submit" value="Modifier Status" /></td>
                <td><a href="<?=site_url('Admin/cancelOrderConfirm?idorder='.$order->getId())?>">Annuler commande</a></td>
            </tr>
        </table>

        </form>

    <?php }} else { ?>

        <p>Aucune Commandes</p>

    <?php } ?>

</div>

<!-- Admin/order -->