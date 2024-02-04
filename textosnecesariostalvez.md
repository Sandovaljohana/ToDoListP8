     <select id="stage" class="mb-4 p-2 bg-red-200 rounded-sm w-11/12" name="stage">
                            <option id="1" value="1">High</option>
                            <option id="2" value="2">Medium</option>
                            <option id="3" value="3">Low</option>
                        </select> 



                         <ul>
                        <?php
                        foreach ($results as $result) { ?>
                            <li>
                                <input type="checkbox" id="task" name="task" class="mr-2">
                                <label for="task" class="text-gray-800"><?php echo $result['task']; ?></label>
                                <button class="ml-4" onclick="editTask(<?php echo $result['id']; ?>)">
                                    <i class="fa-solid fa-pencil"></i>
                                </button>
                                <a href="?id=<?php echo $result['id']; ?>">
                                    <i class="fa-solid fa-trash"></i>
                                </a>
                            </li>
                        <?php } ?>
                    </ul>