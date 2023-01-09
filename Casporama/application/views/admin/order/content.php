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

    <?php echo form_open('Admin/order') ?>
    <div class="admin_order_filter">
        <div class="filter_title">
            <h2>Filtre</h2>
        </div>
        <hr>
        <div class="filter_content">
            <div class="btn">
                <input type='text' name='filtre' placeholder="N° de commande"/>
                <input type="submit" value='Rechercher'>
            </div>
            <div class="btn">
                <a href="<?php echo site_url('Admin/Order') ?>">Annuler filtre</a>
            </div> 
        </div>
    </div>
    </form>


    <?php if (isset($resultat)) { ?>
    
        <p style='color:red'><?= $resultat ?></p>

    <?php } ?>

    <div class="admin_order_list">
        <div class="order_list_title">
            <h2>Liste des commandes</h2>
        </div>

        <hr>

        <div class="list_content">
            <table>
                <tr>
                    <th>Numéro de commande</th>
                    <th>Nom du client</th>
                    <th>Date de commande</th>
                    <th>Status de la commande</th>
                </tr>
        <?php if (isset($orders)) { foreach ($orders as $order) { 
            
            echo form_open('Admin/changeStatusOrder'); ?>
            <div class="box">
                <tr>
                    <td><?= $order->getId() ?></td>
                    <td><?= $user[$order->getId()]->getNom(). " " .$user[$order->getId()]->getPrenom() ?></td>
                    <td><?= $order->getDate() ?></td>
                    <td><?= $order->getState() ?></td>
                    <td>Nouveau status : <?php echo form_dropdown($order->getId(),$options,$order->getState()); ?></td>
                    <td><input type="submit" value="Modifier Status" /></td>
                    <td><a href="<?=site_url('Admin/cancelOrder?idorder='.$order->getId())?>">Annuler commande</a></td>
                </tr>
            </div>
            </form>

        <?php }} else { ?>

            <p>Aucune Commandes</p>

        <?php } ?>
            </table>
        </div>
        
    </div>

    

</div>

<!-- Admin/order -->