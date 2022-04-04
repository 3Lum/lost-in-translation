import * as THREE from './js/three.module.js';
import { OrbitControls } from './js/OrbitControls.js';
import {GLTFLoader} from './js/GLTFLoader.js';

var c = document.getElementById("webgl");

let scene = new THREE.Scene();

const loader = new GLTFLoader();
let models = ['./models/test.gltf'];
loader.load(models[0], function ( gltf ) {
        let newmesh = gltf.scene;
        newmesh.position.set(0,((window.innerWidth / window.innerHeight) - 10),0);
        scene.add( newmesh );
        }
);

// Lights

var light = new THREE.PointLight(0xFFFFFF, 1, 500);
light.position.set(10,0,25);
scene.add(light);
var light2 = new THREE.PointLight(0xFFFFFF, 1, 500);
light2.position.set(-10,0,-25);
scene.add(light2);
var light3 = new THREE.PointLight(0xFFFFFF, 1, 500);
light3.position.set(0,15,0);
scene.add(light3);
var light4 = new THREE.PointLight(0xFFFFFF, 1, 500);
light4.position.set(0,-15,0);
scene.add(light4);

/**
 * Sizes
 */
const sizes = {
    width: window.innerWidth,
    height: window.innerHeight -50
}

window.addEventListener('resize', () =>
{
    // Update sizes
    sizes.width = window.innerWidth
    sizes.height = window.innerHeight -50

    // Update camera
    camera.aspect = sizes.width / sizes.height
    camera.updateProjectionMatrix()

    // Update renderer
    renderer.setSize(sizes.width, sizes.height)
    renderer.setPixelRatio(Math.min(window.devicePixelRatio, 2))
})

document.getElementById('btn2').addEventListener('click', () => {
    if (controls.autoRotate){
        controls.autoRotate = false;
    }
    else{
        controls.autoRotate = true;
    }
});
document.getElementById('btn3').addEventListener('click', () => {
    if (controls.autoRotateSpeed > 0){
        controls.autoRotateSpeed = -2.0;
    }
    else{
        controls.autoRotateSpeed = 2.0;
    }
});



/**
 * Camera
 */
// Base camera
const camera = new THREE.PerspectiveCamera(50,window.innerWidth / window.innerHeight,0.1,1000);
camera.position.set(0,0,20);
scene.add(camera)

// Controls
const controls = new OrbitControls(camera, c)
controls.enableDamping = true

document.getElementById('btn1').addEventListener("click", () =>{
    controls.reset();
});

/**
 * Renderer
 */
const renderer = new THREE.WebGLRenderer({
    canvas: c
})
renderer.setSize(sizes.width, sizes.height)
renderer.setPixelRatio(Math.min(window.devicePixelRatio, 2))

/**
 * Animate
 */

/*const clock = new THREE.Clock()

const tick = () =>
{

    const elapsedTime = clock.getElapsedTime()

    // Update objects
    sphere.rotation.y = .5 * elapsedTime

    // Update Orbital Controls
    // controls.update()

    // Render
    renderer.render(scene, camera)

    // Call tick again on the next frame
    window.requestAnimationFrame(tick)
}

tick()*/

var render = function(){
    requestAnimationFrame(render);

    controls.update();
    renderer.render(scene,camera);
}
render(); 