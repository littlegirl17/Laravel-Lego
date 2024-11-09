<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>@yield('title')</title>
    <link rel="icon" type="image/png" href="{{ asset('uploads/HK.png') }}" />
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v6.4.0/css/all.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous" />
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <style>
        canvas {
            display: block;
            width: 100%;
            height: 100%;
        }

        #controls {
            position: absolute;
            top: 10px;
            left: 10px;
            z-index: 10000;
        }

        .container_bock {
            width: 100%;
            height: 100vh;
            background-color: #000000;
            position: relative;
            /* Đảm bảo controls nằm trên container */
        }
    </style>
</head>

<body>
    <div class="container_bock">
        <div id="controls">
            <button id="addBlock">Thêm Khối LEGO</button>
            <button id="saveBlock">Lưu Vị Trí Khối</button>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/three.js/r128/three.min.js"></script>

    <script>
        let scene, camera, renderer;
        let blocks = [];
        let selectedBlock = null;
        let raycaster = new THREE.Raycaster();
        let mouse = new THREE.Vector2();

        function init() {
            scene = new THREE.Scene();
            camera = new THREE.PerspectiveCamera(75, window.innerWidth / window.innerHeight, 0.1, 1000);
            renderer = new THREE.WebGLRenderer({
                alpha: true
            });
            renderer.setSize(window.innerWidth, window.innerHeight);
            document.querySelector('.container_bock').appendChild(renderer.domElement);

            const light = new THREE.AmbientLight(0x404040);
            scene.add(light);
            camera.position.z = 5;

            document.getElementById("addBlock").addEventListener("click", addBlock);
            document.getElementById("saveBlock").addEventListener("click", saveSelectedBlockPosition);

            window.addEventListener("mousedown", onMouseDown);
            window.addEventListener("mouseup", onMouseUp);
            window.addEventListener("mousemove", onMouseMove);
            window.addEventListener("resize", onWindowResize);

            fetchBlocksFromDB();
            animate();
        }

        function addBlock() {
            const geometry = new THREE.BoxGeometry(1, 1, 1);
            const material = new THREE.MeshBasicMaterial({
                color: Math.random() * 0xffffff
            });
            const block = new THREE.Mesh(geometry, material);

            block.position.set((Math.random() - 0.5) * 4, (Math.random() - 0.5) * 4, (Math.random() - 0.5) * 4);

            saveBlockToDB(block.position, material.color.getHexString(), block);

            scene.add(block);
            blocks.push(block);
        }

        function saveBlockToDB(position, color, block) {
            fetch('/blocks', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({
                        position_x: position.x,
                        position_y: position.y,
                        position_z: position.z,
                        color: `#${color}`
                    })
                })
                .then(response => response.json())
                .then(data => {
                    block.id = data.id;
                    console.log('Khối đã được lưu:', block.id);
                })
                .catch(error => console.error('Lỗi:', error));
        }

        function fetchBlocksFromDB() {
            fetch('/blocks')
                .then(response => response.json())
                .then(data => {
                    data.forEach(blockData => {
                        const geometry = new THREE.BoxGeometry(1, 1, 1);
                        const material = new THREE.MeshBasicMaterial({
                            color: blockData.color
                        });
                        const block = new THREE.Mesh(geometry, material);

                        block.position.set(
                            parseFloat(blockData.position_x),
                            parseFloat(blockData.position_y),
                            parseFloat(blockData.position_z)
                        );

                        block.id = blockData.id;
                        scene.add(block);
                        blocks.push(block);
                    });
                })
                .catch(error => console.error('Lỗi khi lấy khối:', error));
        }

        function onMouseDown(event) {
            mouse.x = (event.clientX / window.innerWidth) * 2 - 1;
            mouse.y = -(event.clientY / window.innerHeight) * 2 + 1;

            raycaster.setFromCamera(mouse, camera);
            const intersects = raycaster.intersectObjects(blocks);

            if (intersects.length > 0) {
                selectedBlock = intersects[0].object;
            } else {
                selectedBlock = null; // Nếu không có khối nào được chọn
            }
        }

        function onMouseUp() {
            if (selectedBlock) {
                // Kiểm tra xem vị trí đã thay đổi chưa
                if (selectedBlock.hasMoved) {
                    // Lưu vị trí mới của khối vào cơ sở dữ liệu
                    saveBlockPositionToDB(selectedBlock);
                }
            }
            selectedBlock = null;
        }


        function onMouseMove(event) {
            if (selectedBlock) {
                mouse.x = (event.clientX / window.innerWidth) * 2 - 1;
                mouse.y = -(event.clientY / window.innerHeight) * 2 + 1;

                raycaster.setFromCamera(mouse, camera);

                const intersects = raycaster.intersectObject(new THREE.Mesh(
                    new THREE.PlaneGeometry(1000, 1000),
                    new THREE.MeshBasicMaterial({
                        visible: false
                    })
                ));

                if (intersects.length > 0) {
                    selectedBlock.position.copy(intersects[0].point);
                }
            }
        }

        function onMouseMove(event) {
            if (selectedBlock) {
                mouse.x = (event.clientX / window.innerWidth) * 2 - 1;
                mouse.y = -(event.clientY / window.innerHeight) * 2 + 1;

                raycaster.setFromCamera(mouse, camera);

                // Tìm giao điểm với mặt phẳng
                const intersects = raycaster.intersectObject(new THREE.Mesh(
                    new THREE.PlaneGeometry(1000, 1000),
                    new THREE.MeshBasicMaterial({
                        visible: false
                    })
                ));

                if (intersects.length > 0) {
                    selectedBlock.position.copy(intersects[0].point);
                    selectedBlock.hasMoved = true; // Đánh dấu khối đã di chuyển
                }
            }
        }

        function saveSelectedBlockPosition() {
            if (selectedBlock) {
                saveBlockPositionToDB(selectedBlock);
            } else {
                console.log("Không có khối nào được chọn.");
            }
        }

        function saveBlockPositionToDB(block) {
            if (!block || !block.id) {
                console.log("Block hoặc ID của khối không tồn tại:", block);
                return;
            }

            fetch(`/blocks/${block.id}`, {
                    method: 'PUT',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({
                        position_x: block.position.x,
                        position_y: block.position.y,
                        position_z: block.position.z
                    })
                })
                .then(response => {
                    if (!response.ok) {
                        throw new Error(`HTTP error! status: ${response.status}`);
                    }
                    return response.json();
                })
                .then(data => {
                    console.log('Vị trí khối đã được lưu:', data);
                    block.hasMoved = false; // Reset trạng thái sau khi lưu
                })
                .catch(error => {
                    console.error('Lỗi khi lưu vị trí khối:', error);
                });
        }


        function onWindowResize() {
            camera.aspect = window.innerWidth / window.innerHeight;
            camera.updateProjectionMatrix();
            renderer.setSize(window.innerWidth, window.innerHeight);
        }

        function animate() {
            requestAnimationFrame(animate);
            renderer.render(scene, camera);
        }

        init();
    </script>
</body>

</html>
